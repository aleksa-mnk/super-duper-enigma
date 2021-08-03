$(function() {
	var tab = $('#tabs .tabs-items > div'); 
	tab.hide().filter(':first').show(); 
	$('#tabs .tabs-nav a').click(function(){
		tab.hide(); 
		tab.filter(this.hash).show(); 
		$('#tabs .tabs-nav a').removeClass('active');
		$(this).addClass('active');
		return false;
	}).filter(':first').click();

	$('.tabs-target').click(function(){
		$('#tabs .tabs-nav a[href=' + $(this).data('id')+ ']').click();
	});
});

$(document).ready(function () {
     $("#btn").click(function () {
          startDate = $(".startDate").val();
          finishDate = $(".finishDate").val();
 
          // проверка на корректность введенных значений
          if (startDate == '' || finishDate == '') {
               alert("Заполните все поля!");
               
               console.log(startDate);
               return false;
          }
 
          // отправка ajax-запроса к файлу index.php 
          $.ajax({
               type: "POST",
               url: "index.php",
               data: {
                    "startDate": startDate,
                    "finishDate": finishDate,
                 },
               success: function (data) {
                    // передаём результат в див с id result
                    $('#result').html(data);
               }
          })
     });
 });