<?php
use App\Timeline;
use Nayjest\Grids\Grid;
use Nayjest\Grids\GridConfig;
use Nayjest\Grids\EloquentDataProvider;
use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\EloquentDataRow;

debug($timeline);
$val = $timeline->id;

$grid = new Grid(
    (new GridConfig)
        ->setName('transactions-table')
        ->setDataProvider(new EloquentDataProvider($query))
        ->setPageSize(Config::get('sets.bidPginatorSize'))
//        ->setCachingTime(5) 
        ->setColumns([
            (new FieldConfig)
                ->setName('id')
                ->setLabel(trans('common.transaction_id'))
                ->setSortable(true)
            ,
            (new FieldConfig)
                ->setName('client_who')
                ->setLabel(trans('common.transaction_who'))
                ->setCallback(function ($val, EloquentDataRow $row) use ($timeline) {
                    $clientId = ($row->getSrc()->client_from == $timeline->id) ? 
                        $row->getSrc()->client_to : $row->getSrc()->client_from;                   
                    $client = Timeline::whereId($clientId)->first();

                    return $client->username;
                })
                ->setSortable(true)
            ,        
            (new FieldConfig)
                ->setName('amount')
                ->setLabel(trans('common.transaction_amount_from'))
                ->setCallback(function ($val, EloquentDataRow $row) use ($timeline) {
                    if($row->getSrc()->client_from == $timeline->id)
                    {
                        $result = '';
                        $color = 'danger';    
                    }
                    else
                    {
                        $result = $row->getSrc()->amount;
                        $color = 'success';
                    }                    
                    return "<span class='label label-$color'>" . $result . '</span>';
                })
                ->setSortable(true)
            ,
            (new FieldConfig)
                ->setName('amount')
                ->setLabel(trans('common.transaction_amount_to'))
                ->setCallback(function ($val, EloquentDataRow $row) use ($timeline) {                    
                    if($row->getSrc()->client_to == $timeline->id)
                    {
                        $result = '';
                        $color = 'danger';    
                    }
                    else
                    {
                        $result = $row->getSrc()->amount;
                        $color = 'success';
                    }                   
                    return "<span class='label label-$color'>" . $result . '</span>';
                })
                ->setSortable(true)
            ,        
            (new FieldConfig)
                ->setName('action')
                ->setLabel(trans('common.transaction_type'))
                ->setSortable(true)
                ->setCallback(function ($val, EloquentDataRow $row) {
                    $transaction = $row->getSrc();
                    
                    debug($transaction->action_color);
                    
                    return  "<span class='label label-$transaction->action_color'>" . $transaction->action . '</span>';
                })
            ,
            (new FieldConfig)
                ->setName('created_at')
                ->setLabel(trans('common.transaction_date'))
                ->setCallback(function ($val, EloquentDataRow $row) {
                    $date = (new DateTime($val))->format('d-m-y  H:i:s');
                    return $date;
                })
            ,
        ])
);
                
echo $grid->render();

