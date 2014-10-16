<?php
 header('Content-Type: text/html; charset=utf-8');

$public_key =	'';
$private_key =	'';

$fh2 = fopen('number.txt','a+');
$number = intval(fread($fh2,1024))+1;
fclose($fh2);

$fh3 = fopen('number.txt','w+');
fputs($fh3,$number);
fclose($fh3);



 ?>
<html>
<head>
<title>Оплата услуг Юридической компании Шлях до Мрії О.К.</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<style>
    fieldset {
    width: 500px;
    text-align: center;
    border-radius: 10;
    border: 5px solid #449944;
    position: relative;    
    font-family: Arial,times new roman;
    }
    
    input[name="currency_d"] {
    width: 50px;
    }
    
    input#amount {
    width: 50px;
    }
    
    legend {
    border: 3px solid #449944;
    border-radius: 5px;
    padding: 5px;
    font-size: 32;
    font-family: Arial,Monotype Corsiva,times new roman;
    }

</style>

<script>
$('form#pay_form').live('submit',function(){
    //alert('ddd');
    var d = document.getElementById('description').value;
    document.getElementById('description').value = d+' ('+document.getElementById('deal_who').value+', договор №'+document.getElementById('deal_number').value+')';
    return false;
})

/*
https://www.liqpay.com/api/pay
*/
</script>

</head>
<body>
<div style="width: 100%;">
    <fieldset><legend>Заполните форму оплаты</legend>
        <form id="pay_form" method="POST" accept-charset="utf-8" action="?" target="_parent">
        
        
    <table style="border:none; width: 100%;">
        <tr>
        	<td style="text-align: right;width:45%" ><strong>Укажите сумму:</strong></td>
        	<td>
            <input type="text" name="amount" id="amount" value="1000" />
            <input type="text" disabled="disabled" name="currency_d" value="UAH" />
            </td>
        </tr>
        <tr>
        	<td style="text-align: right;"><strong>Укажите услугу:</strong></td>
        	<td><textarea name="description" id="description"  style="width: 100%;" >Юридическая услуга</textarea></td>
        </tr>
        
        <tr>
        	<td style="text-align: right;"><strong>Укажите на кого оформлен договор (ФИО):</strong></td>
        	<td><input type="text" name="deal_who" id="deal_who" value="" /></td>
        </tr>
        
        <tr>
        	<td style="text-align: right;"><strong>Укажите Номер договора:</strong></td>
        	<td><input type="text" name="deal_number" id="deal_number" value="" /></td>
        </tr>
        <!--
        <tr>
        	<td style="text-align: right;"><em>Тестовый платёж (деньги не снимаются):</em></td>
        	<td><input type="checkbox" name="sandbox" id="sandbox" value="1" /></td>
        </tr>
-->
        <tr>
        	<td style="text-align: right;"><em>Номер Вашего заказа:</em></td>
        	<td><?=$number;?></td>
        </tr>
    
        <tr>
        	<td colspan="2"  style="text-align: center;"><input type="image" src="//static.liqpay.com/buttons/p1ru.radius.png" name="btn_text" /></td>
        </tr>
    </table>
        
        
        
            <input type="hidden" name="currency" value="UAH" />
            <input type="hidden" name="public_key" value="<?=$public_key;?>" /> 
            <input type="hidden" name="type" value="buy" />
            <input type="hidden" name="pay_way" value="card,delayed" />
            <input type="hidden" name="server_url" value="http://www.viaestvita.kiev.ua/test/server.php" />
            <input type="hidden"  name="order_id" id="order_id" value="<?=$number;?>" />
            <input type="hidden" name="language" value="ru" />
            <input type="hidden" name="signature" id="signature" value=""/>
            <input type="hidden" name="result_url" value="http://www.viaestvita.kiev.ua/test/result.php"/>
            
        </form>
    </fieldset>
</div>

<!--

<hr />

<div id="result"></div>
-->

<!---->

<script type="text/javascript">


   $('#pay_form').on("keyup click", function () {
        var amount = document.getElementById('amount').value;
    	var description = document.getElementById('description').value;
    	var order_id = document.getElementById('order_id').value;
    	/*var sandbox = (document.getElementById('sandbox').checked ? 1 : 0 );*/
    

		$.ajax({
			type: "POST",
			url: "lp_ajax.php",
			data: "amount="+amount+"&description="+description+"&order_id="+order_id/*+"&sandbox="+sandbox*/,


			success: function(data)
			{			 
                var res_arr = data.split("+++___+++");
				document.getElementById('signature').value = res_arr[0];
				/**
 * document.getElementById('result').innerHTML = res_arr[1];
 */
			}

		});
		return true;
	});
    
   $( document ).ready(function() {
        var amount = document.getElementById('amount').value;
    	var description = document.getElementById('description').value;
    	var order_id = document.getElementById('order_id').value;
    	/*var sandbox = (document.getElementById('sandbox').checked ? 1 : 0 );*/
    

		$.ajax({
			type: "POST",
			url: "lp_ajax.php",
			data: "amount="+amount+"&description="+description+"&order_id="+order_id/*+"&sandbox="+sandbox*/,


			success: function(data)
			{			 
                var res_arr = data.split("+++___+++");
				document.getElementById('signature').value = res_arr[0];
				/**
 * document.getElementById('result').innerHTML = res_arr[1];
 */
			}

		});
		return true;
	});
</script>



</body>
</html> 



