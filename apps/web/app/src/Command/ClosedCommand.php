<?php
namespace App\Command;

/**
 * サンプル用　
 **/

use App\Model\Entity\Order;
use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
class ClosedCommand extends Command
{
    public function initialize()
    {
        parent::initialize();
//        $this->loadModel('DeliveryCloseds');
//        $this->loadModel('OrderItemHeads');
//        $this->loadModel('OrderItems');
//        $this->loadModel('Schedules');
    }
    protected function buildOptionParser(ConsoleOptionParser $parser)
    {
        $parser = parent::buildOptionParser($parser);

        $parser->addArgument("date", [ // id をArgumentsに指定
            'help' => "締める対象日",
            'required' => false
        ]);
        // 複数指定
//        $parser
//            ->addArguments([
//                'id' => ['required' => true],
//                'basedir' => ['required' => true],
//            ]);
        return $parser;
    }

    public function execute(Arguments $args, ConsoleIo $io)
    {
//        $date = $args->getArgument('date');
//        $now = new \DateTime();
//        if (empty($date)) {
//            $date = $now->format('Y-m-d');
//        }
//
//        Log::info('注文締め処理--開始', 'cmd_closed');
//
//        $at = new \DateTime($date);
//
//        // 営業日の確認
//        $schedule = $this->Schedules->find()->where(['date' => $at->format('Y-m-d'), 'status' => 1])->first();
//        if(!empty($schedule)) {
//            Log::info('注文締め処理--営業日外のため繰越し', 'cmd_closed');
//            return;
//        }
//
//        // 締め処理の対象となる条件
//        $cond = [
//            'Orders.status' => 'publish',
//            'Orders.order_datetime <' => $at->format('Y-m-d 00:00:00'),
//            'OrderItems.delivery_status' => Order::DELIVERY_STATUS_READY,
//            'OrderItems.close_disabled' => 0,
//            'OrderItems.is_closed' => 0
//        ];
//        $contain = [
//            'Orders',
//        ];
//        $save_columns = ['is_closed', 'closed_date'];
//        $order_items = $this->OrderItems->find()->where($cond)->contain($contain)->order(['Orders.order_datetime' => 'ASC'])->all();
//
//        $success_cnt = 0;
//        $error_cnt = 0;
//
//        if (!$order_items->isEmpty()) {
//            foreach ($order_items as $order_item) {
//                $update = [];
//                Log::info("order_item_id={$order_item->id}", 'cmd_closed');
//
//                $update['is_closed'] = 1;
//                $update['closed_date'] = $now->format('Y-m-d');
//
//                $entity = $this->OrderItems->patchEntity($order_item, $update, ['fieldList' => $save_columns]);
//                $r = $this->OrderItems->save($entity);
//                if ($r) {
//                    $success_cnt++;
//                } else {
//                    $error_cnt++;
//                }
//            }
//
//            Log::info('締め処理結果　成功=' . $success_cnt . '、失敗=' . $error_cnt, 'cmd_closed');
//
//        } else {
//            Log::info('対象のデータはありませんでした', 'cmd_closed');
//        }
//
//        $io->out("日付 {$date}.");
//        Log::info('注文締め処理--終了', 'cmd_closed');
    }
}