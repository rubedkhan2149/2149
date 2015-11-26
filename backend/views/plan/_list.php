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
                <th style="width:200px">Plan Name</th>
                <th style="width:300px">Plan type</th>
                <th style="width:300px">Duration</th>
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
                        <td><?php echo ucfirst($record['plan_name']); ?></td>
                        <td><?php echo ucfirst($record['plan_type']); ?></td>
                        <td>
                        <?php 
                            if($record['duration']!='-1')
                            {
                                echo $record['duration'];
                            }
                            else
                            {
                                echo "-";
                            }
                        ?>
                        </td>
                        
                        <td>
                            <ul class="list-inline editviewdel">
                                <li><a href="#add-plan" onclick="planForm(<?php echo $record['id']; ?>)" data-toggle="modal" data-target="#add-plan"><i class="fa fa-edit"></i></a></li>
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
