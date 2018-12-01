<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="js/jquery-1.9.0.min.js"></script>
	<script src="js/Storage.js"></script>
	<style>
	*{padding:0;margin:0;list-style:none;font-family:tahoma; -webkit-box-sizing:border-box;-moz-box-sizing:border-box;-ms-box-sizing:border-box;box-sizing:border-box;}
	.clear:after{content:'.';height:0;clear:both;display:block;overflow:hidden;visibility:hidden;}

	#loading{width:100px;height:100px; display:none; z-index:55;top:-2px;left:0;right:0;margin:auto; position:fixed; box-shadow:0 16px 15px -15px #555;background-image:url('img/loading2.gif');background-color:#FFF;background-size:250px;background-position:center;border:1px solid #CCC;}
	
	form{width:350px;height:40px;margin:20px auto;border:1px solid #CCC;}
	form input{float:left; width:70%;height:100%;border:0;outline:none;border-right:1px solid #CCC;padding:0 10px;font-size:18px;color:#999;}
	form button{float:left; width:30%;height:100%;border:0;outline:none;font-size:18px;background:#DDD;color:#999;cursor:pointer;}
	
	#icones{width:900px;min-height:200px;margin:0 auto;}

	.icon{width:110px;height:110px;margin:5px;float:left;border:1px solid #CCC; text-transform:capitalize !important;}
	.icon-img{height:80%;background-color:#FFF;background-repeat:no-repeat;background-position:center;background-size:50%;}
	.icon-nome{display:block; height:20%;padding-top:3px;background:#DDD;border-top:1px solid #CCC;font-size:13px;text-align:center;color:#777;text-decoration:none;}
	
	</style>
	<script>
	$(function(){

		String.prototype.sprintf=function(){var $this=this;for(var i in arguments){$this=$this.replace('%s',arguments[i]);} return $this;}
		function end(arr){return arr[arr.length-1];}
		function capitalize(str){return str.toLowerCase().replace( /(^| )(\w)/g, function(x){return x.toUpperCase();} );}

		var parado = 1;

		function adc(url){
			if(parado){
				var dados = {};
				dados.meta = [];

				parado = 0;
				$('#loading').slideDown();

				dados.time = setTimeout(function(){
					$('#getting').remove();
					$('#loading').slideUp();
					parado++;

					alert('Não foi possível completar o pedido...');
				},14000);

				$.post('functions.php', {url:url}, function(ret){
					
			    	if(ret){

				    	$('body').append( $('<div/>', {id:'getting', html:ret}) );

				    	dados.title = $('#getting title').text();
				    	dados.title = (dados.title.length>11? '%s...'.sprintf(dados.title.substring(0,11)): dados.title);

				    	$('#getting meta').each(function(){
				    		var ext = end(this.content.split('.'));
				    		switch(ext){ case'ico':case'png':case'jpg':case'jpeg':case'gif': this.name='icon'; break; }
				    		dados.meta[this.name] = this.content;
			    		});

			    		dados.img = (dados.meta['icon']? dados.meta['icon']: ($('#getting link[rel*="icon"]').attr('href1')? $('#getting link[rel*="icon"]').attr('href1'): 'http://localhost/teedHome/img/logo.png'));
			    		dados.img = (dados.img.indexOf('http')<0? url: '') + dados.img;
			    		
			    		dados.url = url;

				    	inserir(dados);

				    	var itens = $.Storage.loadItem('sites')||new Array();

				    	itens.push(dados);

				    	$.Storage.saveItem('sites', itens);

				    	$('#getting').remove();
				    	$('form input').val('');
						$('#loading').slideUp();
						parado++;
						clearTimeout(dados.time);
				    }
				});
			}
		}

		function inserir(dados){
			$('<div/>',{class:'icon'})
	    	.append(
	    		$('<div/>',{class:'icon-img'}).css('background-image', 'url("%s")'.sprintf(dados.img) )
	    	)
	    	.append(
	    		$('<a/>',{class:'icon-nome', html:dados.title, href:dados.url, target:'_blank'})
	    	)
	    	.appendTo('#icones');
		}

		if($.Storage.loadItem('sites')){
			var sites = $.Storage.loadItem('sites');

			for(var x in sites){
				inserir(sites[x]);
			}
		}

		$('form').submit(function(e){
			var site = $(this).children('input').val();

			if(site){
				site = (site.indexOf('http')>=0? '': 'http://') +site;
				adc(site);
			}

			e.preventDefault();
		});

	});
	</script>
</head>
<body>
	
	<div id="loading"></div>
	
	<form class="clear">
		<input type="text" placeholder="url do site">
		<button>Adicionar</button>
	</form>

	<div id="icones"></div>

</body>
</html>