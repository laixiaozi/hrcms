    <textarea id="html" rows=10 cols=60 name="html">原码html</textarea>
    <textarea id="regex" rows=10 cols=60 name="regex"><table[^>]*>(.*?)</table></textarea>
    <input type="text" id="filename" name="filename" value="filename" />
    <br>
    <textarea id="result" rows=10 cols=60>生成结果</textarea>
    <button id="submit">开始..</button>
    <button id="clear">开始..</button>
<?php $this->beginBlock('pregHtml') ?>
    $("#submit").on('click', function(){
       var htmlcode = $('#html').val();
       var regcode  = $('#regex').val();
       var filename = $('#filename').val();
       $.post('',{'html':htmlcode , 'reg':regcode ,'fileName':filename}, function(e){
        console.log(e);
        $("#result").val(e);
    }, 'json');
    });

    $("#clear").on('click', function(){
       $('#html').val('');
    $("#result").val('');
    }


<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['pregHtml'], \yii\web\View::POS_END); ?>
