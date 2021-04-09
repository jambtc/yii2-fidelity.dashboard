<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

use app\models\Users;
use app\components\Rows;
use app\components\WebApp;

?>
<div class="card bg-dark px-3">
    <div class="card-header border-transparent">
    <h3 class="card-title">Latest Orders</h3>

    <!-- <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove">
        <i class="fas fa-times"></i>
      </button>
    </div> -->
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
    <!-- <div class="table-responsive">
      <table class="table m-0">
        <thead>
        <tr>
          <th>Order ID</th>
          <th>Item</th>
          <th>Status</th>
          <th>Popularity</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td><a href="pages/examples/invoice.html">OR9842</a></td>
          <td>Call of Duty IV</td>
          <td><span class="badge badge-success">Shipped</span></td>
          <td>
            <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
          </td>
        </tr>
        <tr>
          <td><a href="pages/examples/invoice.html">OR1848</a></td>
          <td>Samsung Smart TV</td>
          <td><span class="badge badge-warning">Pending</span></td>
          <td>
            <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
          </td>
        </tr>
        <tr>
          <td><a href="pages/examples/invoice.html">OR7429</a></td>
          <td>iPhone 6 Plus</td>
          <td><span class="badge badge-danger">Delivered</span></td>
          <td>
            <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
          </td>
        </tr>
        <tr>
          <td><a href="pages/examples/invoice.html">OR7429</a></td>
          <td>Samsung Smart TV</td>
          <td><span class="badge badge-info">Processing</span></td>
          <td>
            <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
          </td>
        </tr>
        <tr>
          <td><a href="pages/examples/invoice.html">OR1848</a></td>
          <td>Samsung Smart TV</td>
          <td><span class="badge badge-warning">Pending</span></td>
          <td>
            <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
          </td>
        </tr>
        <tr>
          <td><a href="pages/examples/invoice.html">OR7429</a></td>
          <td>iPhone 6 Plus</td>
          <td><span class="badge badge-danger">Delivered</span></td>
          <td>
            <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
          </td>
        </tr>
        <tr>
          <td><a href="pages/examples/invoice.html">OR9842</a></td>
          <td>Call of Duty IV</td>
          <td><span class="badge badge-success">Shipped</span></td>
          <td>
            <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
          </td>
        </tr>
        </tbody>
      </table>
    </div> -->
    <!-- /.table-responsive -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'layout' => "{summary}\n{items}\n{pager}",
        'layout' => "{summary}\n{items}",
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'id',
                'format' => 'raw',
                'value' => function ($data) {
                    $id = WebApp::encrypt($data->id);
                    return Html::a($id, Url::toRoute(['/invoices/view', 'id' => $id]),
                            [
                                'class' => 'btn btn-success center-block text-truncate',
                                'style' => 'width: 150px;'
                            ]
                        );
                    },
            ],
            [
                'attribute' => 'id_user',
                'format' => 'raw',
                'value' => function ($data) {
                    return Users::find()
                        ->andWhere(['id'=>$data->id_user])
                        ->one()->denomination;
                },
                'visible' => (Yii::$app->user->id == 1) ? true : false,
            ],
            //'status',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($data) {
                    $color = Rows::statuscolor($data->status);
                    $row = '<span class="badge badge-'.$color.'">'.$data->status.'</span>';
                    return $row;
                },
            ],
            'price',
            'received',
            //'id_pos',
            'invoice_timestamp:datetime',
            //'expiration_timestamp:datetime',
            //'from_address',
            //'to_address',
            //'txhash',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
    <!-- /.card-body -->
    <!-- <div class="card-footer clearfix">
    <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
    <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
    </div> -->
    <!-- /.card-footer -->
</div>
