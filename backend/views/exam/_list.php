<?php use yii\helpers\Url; ?>
<script type="text/javascript">
$().ready(function(){
    $("[name='my-checkbox']").bootstrapSwitch();
    $('input[name="my-checkbox"]').on('switchChange.bootstrapSwitch', function(event, state) {
    var examRowId=$(this).attr('id'); // DOM element
    var res = examRowId.split("_");
    var examId=res[1];
    var status='';
    if(state){
        status='inactive';
    }else{
        status='active';
    } // true | false
    var url = url || "<?php echo \yii::$app->urlManager->createUrl(['exam/change-status'])?>";
    $.ajax({type:"POST",url:url,data: {
         examId: examId,
         status: status
      },success:function(data){
        $(".overlay").hide();    
        console.log(data);
    }});
});
   
    $("#examPager li a").on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        var href = $this.attr('href');
        var paginate_class = $(this).closest("li").attr('class');
        if (paginate_class != 'active')
        {
            get_exam_list(href);
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
                <th style="width:200px">Sr.No</th>
                <th style="width:300px">Exam Name</th>
                <th style="width:300px">Created on</th>
                <th style="width:200px">Status</th>
                <th style="width:100px">Action</th>
            </tr>
        </thead>
        <tbody>
         <?php
            if($dataProvider->totalCount>=1)
            {
                $i=1;
                $records = $dataProvider->getModels();
                foreach($records as $record)
                {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $record['exam_name']?></td>
                        <td>
                        <?php 
                        if($record['created_at']!='')
                        {
                            echo date("d-m-Y",  strtotime($record['created_at']));
                        }
                        ?>
                        </td>
                        <td>
                            <?php 
                            if($record['status']=='active'){
                                $checked='checked';
                            }else{
                                $checked='';
                            } ?>
                            <input type="checkbox" name="my-checkbox" id="status_<?php echo $record['id']?>" data-on-color='warning' <?php echo $checked; ?>>
                        </td>
                        <td>
                            <ul class="list-inline editviewdel">
                                <li><a href="<?php echo Url::toRoute(['exam/edit-exam','id'=>$record['id']]); ?>"><i class="fa fa-edit"></i></a></li>
                                <li><a href="javascript:void(0)" onclick="delete_exam(<?php echo $record['id']; ?>)"><i class="fa fa-trash"></i></a></li>
                            </ul>
                        </td>
                    </tr>
                    <?php
                    $i++;
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
            'options'=>['id'=>'examPager','class' => 'pagination'],
            'pagination'=>$dataProvider->pagination,
            //'firstPageLabel'=>'First',
            //'lastPageLabel'=>'Last',
        ]);
    ?> 
</div>
