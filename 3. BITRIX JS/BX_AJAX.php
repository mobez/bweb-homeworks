<?
//подключаем пролог ядра bitrix
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//устанавливаем заголовок страницы
$APPLICATION->SetTitle("AJAX");
    //подключение ядра и одного расширения
   CJSCore::Init(array('ajax'));
   $sidAjax = 'testAjax';
if(isset($_REQUEST['ajax_form']) && $_REQUEST['ajax_form'] == $sidAjax){
   $GLOBALS['APPLICATION']->RestartBuffer();
   echo CUtil::PhpToJSObject(array(
            'RESULT' => 'HELLO',
            'ERROR' => ''
   ));
   die();
}

?>
<div class="group">
   <div id="block"></div >
   <div id="process">wait ... </div >
</div>
<script>
   window.BXDEBUG = true;
function DEMOLoad(){
   BX.hide(BX("block"));
   BX.show(BX("process"));
   BX.ajax.loadJSON(
      '<?=$APPLICATION->GetCurPage()?>?ajax_form=<?=$sidAjax?>',
      DEMOResponse
   );
}
function DEMOResponse (data){
   BX.debug('AJAX-DEMOResponse ', data);
   BX("block").innerHTML = data.RESULT;
   BX.show(BX("block"));
   BX.hide(BX("process"));
   //добавление события объекту 'block', обработчик DEMOUpdate
   BX.onCustomEvent(
      BX(BX("block")),
      'DEMOUpdate'
   );
}
//проверка загрузки DOM. Обязательная функция
BX.ready(function(){
   /*
   BX.addCustomEvent(BX("block"), 'DEMOUpdate', function(){
      window.location.href = window.location.href;
   });
   */
   BX.hide(BX("block"));
   BX.hide(BX("process"));
    /*
    Устанавливает обработчик события на дочерние элементы узла,
    удовлетворяющие заданным условиям
    Добавления функцию элементу с классом 'css_ajax' при событие 'click' и искать элемент в body
    */
    BX.bindDelegate(
      document.body, 'click', {className: 'css_ajax' },
      function(e){
         if(!e)
            e = window.event;
         //вызов функции DEMOLoad() при клике
         DEMOLoad();
         return BX.PreventDefault(e);
      }
   );
   
});

</script>
<div class="css_ajax">click Me</div>
<?
//подключаем эпилог ядра bitrix
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
