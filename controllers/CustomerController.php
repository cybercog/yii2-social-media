<?php

namespace infoweb\ecommerce\sales\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\base\Exception;
use yii\web\Response;
use yii\helpers\ArrayHelper;

use infoweb\ecommerce\sales\models\customer\Customer;
use infoweb\ecommerce\sales\models\customer\Group;
use infoweb\ecommerce\sales\models\customer\Address;
use infoweb\ecommerce\sales\models\search\CustomerSearch;


/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post']
                ],
            ],
        ];
    }

    /**
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // Load the model
        $model = new Customer(['active' => 1]);
        
        // Load customer groups
        $groups = ArrayHelper::map(
            Group::find()
                ->select(['id', 'name'])
                ->joinWith('translations')
                ->where(['language' => Yii::$app->language])
                ->orderBy(['position' => SORT_ASC])
                ->asArray()
                ->all(),
            'id',
            'name'
        );

        try {

            if (Yii::$app->request->getIsPost()) {

                $post = Yii::$app->request->post();

                // Ajax request, validate the models
                if (Yii::$app->request->isAjax) {

                    // Populate the model with the POST data
                    $model->load($post);

                    // Validate the model
                    $response = ActiveForm::validate($model);

                    // Return validation in JSON format
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return $response;

                    // Normal request, save models
                } else {
                    // Wrap the everything in a database transaction
                    $transaction = Yii::$app->db->beginTransaction();

                    // Save the main model
                    if (!$model->load($post) || !$model->save()) {
                        throw new Exception(Yii::t('ecommerce', 'Failed to save the node'));
                    }
                    
                    // Use the model attributes to create the default address model
                    $address = new Address([
                        'customer_id'       => $model->id,
                        'company'           => $model->company,
                        'firstname'         => $model->firstname,
                        'name'              => $model->name,
                        'address'           => $model->address,
                        'zipcode'           => $model->zipcode,
                        'city'              => $model->city,
                        'country_id'        => $model->country_id,
                        'default'           => 1
                    ]);
                    
                    if (!$address->save())
                        throw new Exception(Yii::t('ecommerce', 'Failed to save the node'));

                    $transaction->commit();

                    // Set flash message
                    Yii::$app->getSession()->setFlash('customer', Yii::t('app', '"{item}" has been created', ['item' => "{$model->firstname} {$model->name}"]));

                    // Take appropriate action based on the pushed button
                    if (isset($post['close'])) {
                        return $this->redirect(['index']);
                    } elseif (isset($post['new'])) {
                        return $this->redirect(['create']);
                    } else {
                        return $this->redirect(['update', 'id' => $model->id]);
                    }
                }
            }
        } catch (Exception $e) {

            if (isset($transaction)) {
                $transaction->rollBack();
            }

            // Set flash message
            Yii::$app->getSession()->setFlash('customer-error', $e->getMessage());
        }

        return $this->render('create', [
            'model'     => $model,
            'groups'    => $groups
        ]);
    }

    /**
     * Updates an existing Manufacturer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        // Load customer groups
        $groups = ArrayHelper::map(
            Group::find()
                ->select(['id', 'name'])
                ->joinWith('translations')
                ->where(['language' => Yii::$app->language])
                ->orderBy(['position' => SORT_ASC])
                ->asArray()
                ->all(),
            'id',
            'name'
        );

        try {

            if (Yii::$app->request->getIsPost()) {

                $post = Yii::$app->request->post();

                // Ajax request, validate the models
                if (Yii::$app->request->isAjax) {

                    // Populate the model with the POST data
                    $model->load($post);

                    // Validate the model
                    $response = ActiveForm::validate($model);

                    // Return validation in JSON format
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return $response;

                    // Normal request, save models
                } else {
                    // Wrap the everything in a database transaction
                    $transaction = Yii::$app->db->beginTransaction();

                    // Save the main model
                    if (!$model->load($post) || !$model->save()) {
                        throw new Exception(Yii::t('ecommerce', 'Failed to update the node'));
                    }

                    $transaction->commit();

                    // Set flash message
                    Yii::$app->getSession()->setFlash('customer', Yii::t('app', '{item} has been updated', ['item' => "{$model->firstname} {$model->name}"]));

                    // Take appropriate action based on the pushed button
                    if (isset($post['close'])) {
                        return $this->redirect(['index']);
                    } elseif (isset($post['new'])) {
                        return $this->redirect(['create']);
                    } else {
                        return $this->redirect(['update', 'id' => $model->id]);
                    }
                }
            }
        } catch (Exception $e) {

            if (isset($transaction)) {
                $transaction->rollBack();
            }
            // Set flash message
            Yii::$app->getSession()->setFlash('customer-error', $e->getMessage());
        }

        return $this->render('update', [
            'model'     => $model,
            'groups'    => $groups
        ]);
    }
    
    /**
     * Deletes an existing Manufacturer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * Set active state
     * @param string $id
     * @return mixed
     */
    public function actionActive()
    {
        $model = $this->findModel(Yii::$app->request->post('id'));
        $model->active = ($model->active == 1) ? 0 : 1;

        $data['status'] = $model->save();
        $data['active'] = $model->active;

        Yii::$app->response->format = 'json';
        return $data;
    }
}