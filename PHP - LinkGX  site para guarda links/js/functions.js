$(function(){

	function __rand(a,b){return Math.floor((Math.random()*b)+a);}
	function __first(a){return a[0];}
	function __last(a){return a[a.length-1];}
	String.prototype.sprintf=function(){var $this=this;for(var x=0;x<=arguments.length-1;x++){$this=$this.replace('%s',arguments[x])}return $this}
	
	var buscas = {
		yahoo: 'http://br.search.yahoo.com/search',
		facebook: 'https://www.facebook.com/search/results.php',
		google: 'https://www.google.com.br/search',
		bing: 'http://br.bing.com/search',
		youtube: 'http://www.youtube.com/results'
	};

	buscas.atual = $.Storage.loadItem('busca')||'google';
	buscas.img = 'url("http://localhost/linkgx/img/'+buscas.atual+'.png")';
	$('header #header-busca-caixa').attr('action', buscas[buscas.atual]).children('div').eq(0).css('background-image', buscas.img);

	$('header #header-busca-caixa span').click(function(){
		$('header #header-busca-caixa div:eq(0)').css('background-image', $(this).css('background-image') );
		$('header #header-busca-caixa').attr('action', buscas[$(this).attr('name')] );
		$.Storage.saveItem('busca', $(this).attr('name'), {expires:31});
	});

	$('header #header-busca-caixa div').click(function(){
		$('header #header-busca-caixa div:eq(2)').stop().toggle('fast');

		$('header #header-busca-caixa input').focus();
	});

	$('header #header-busca-caixa').submit(function(){
		if( !$.trim($('header #header-busca-caixa input').val()) ){
			alert('Insira um valor...');
			return false;
		}
	});

	goTo = function(url){
		window.history.pushState(null,null,url);
		$('#goTo').fadeIn(300);
		$('#template').remove();
		$('body').append( $('<div/>').load(url + '?'+last(url.split('/'))+' #template', function(){ $('#goTo').fadeOut(500); }) );
	}
	
});