var
 $box = $('#selectbox'),
 $iterms = $('.option_ul', $box),
 $iterm = $('.option_ul li', $box),
 $btn = $('.arrow'), 
 $showbox = $('.showbox', $box),
 num = $iterm.length;
 $iterm.each(function(i){
  $(this).attr('value',i);
 });
 $btn.click(function(){
  $iterms.slideToggle('slow');    
 });
 $iterm.each(function(i){
  $(this).click(function(){
   $text = $(this).text();
   $value = $(this).attr('value');
   $showbox.text($text);
   $valuebox.attr('value',$value);
  });
 });
