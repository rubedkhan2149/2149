<?php
use yii\helpers\Url;
?>
<script type="text/javascript">
$().ready(function(){
    $("[name='my-checkbox']").bootstrapSwitch();
    $('input[name="my-checkbox"]').on('switchChange.bootstrapSwitch', function(event, state) {
    console.log($(this).attr('id')); // DOM element
    //console.log(event); // jQuery event
    console.log(state); // true | false
});
   
    $("#catPager li a").on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        var href = $this.attr('href');
        var paginate_class = $(this).closest("li").attr('class');
        if (paginate_class != 'active')
        {
            get_category_list(href);
        }
        else{
            //$("#paginationLoader").hide();
        }
    });
});    
</script>

<div class="table-responsive admintable">
    <table class="table">
        <thead>
            <tr>
                <th style="width:200px">Name</th>
                <th style="width:300px">Code</th>
                <th style="width:300px">Discount</th>
                <th style="width:300px">Uses total</th>
                <th style="width:300px">End Date</th>
                <th style="width:200px">Status</th>
                <th style="width:100px">Action</th>
            </tr>
        </thead>
        <tbody>
         <?php
            if($dataProvider->totalCount>=1)
            {
                $records = $dataProvider->getModels();
                foreach($records as $record)
                {
                    ?>
                    <tr>
                        <td><?php echo ucfirst($record['name']);?></td>
                        <td><?php echo $record['code']?></td>
                        <td><?php echo number_format($record['discount'],2)?></td>
                        <td><?php echo $record['uses_total']?></td>
                        <td>
                            <?php 
                            if($record['end_date']!='')
                            {
                                echo date("d-m-Y",  strtotime($record['end_date']));
                            }
                            ?>
                        </td>
                        <td>
                            <input type="checkbox" name="my-checkbox" id="status_<?php echo $record['id']?>" data-on-color='warning' checked>
                        </td>
                        <td>
                            <ul class="list-inline editviewdel">
                                <li><a href="<?php echo Url::toRoute("coupons/add-coupon/".$record['id']); ?>"><i class="fa fa-edit"></i></a></li>
                                <li><a href="javascript:void(0)" onclick="delete_coupon(<?php echo $record['id']; ?>)"><i class="fa fa-trash"></i></a></li>
                            </ul>
                        </td>
                    </tr>
                    <?php
                }
            }
            else
            {
                ?>
                    <tr><td colspan="4">No record found.</td></tr>
                <?php    

            }
         ?>


        </tbody>
    </table>
</div>

<div class="adminpagination text-right col-lg-12">
    <?php 

     echo \yii\widgets\LinkPager::widget([
            'options'=>['id'=>'catPager','class' => 'pagination'],
            'pagination'=>$dataProvider->pagination,
            //'firstPageLabel'=>'First',
            //'lastPageLabel'=>'Last',
        ]);
    ?> 
</div>
