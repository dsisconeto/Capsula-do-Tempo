<?php
$user = new usuario();
$user->selecionarPorId($_SESSION["user"]);

if (isset($_POST['salvar'])) {
    $img = (isset($_FILES) ? $_FILES['img'] : null);
    $erro = null;

    if ($img) {
        $erro = $img['error'];

        if (substr($img['type'], 0, 5) != 'image') {
            $erro = 'Isto não é uma imagem!';
        }

        if (!$erro) {
            $img['nome'] = str_replace('.', '_', md5(uniqid(rand(), true)));
            $img['url'] = sprintf("%s.%s", $img['nome'], (end(explode('.', $img['name']))));
            $img['caminho'] = sprintf("img/usuarios/%s", $img['url']);

            if (!move_uploaded_file($img['tmp_name'], $img['caminho'])) {
                $erro = 'Não foi possível enviar a imagem!';
                $user->atualizaIMG($user->getId(), $img);
            } else {
                // inserir $img['url'] em DB;

                $erro = null;
            }
        }
    }

    $nomeUsuario = (isset($_POST['nomeUsuario']) ? $_POST['nomeUsuario'] : null);

    if (isset($nomeUsuario)) {

        if (strlen($nomeUsuario) < 5) {
            $erro = 'No mínimo 5 caracteres!';
        } else {
            // inserir $login na DB;
            $user->editarNomeUsuario($nomeUsuario, $user->getId());
            $user->editarStatus($user->getId(), 2);
        }
    } else {
        $erro = 'Insira um Nome de Usuario!';
    }

    if (!$erro) {
        header("Location: ./");
    }
}
?>

<script>
    $(function() {

        $('input[name=nomeUsuario]').addClass(($.trim($(this).val() !== '') ? 'ok' : '')).bind('blur focusout keypress keyup', function() {
            var $pai = $(this).parent(),
                    $msg = $pai.children('.template-cadastro-msg'),
                    $input = $pai.children('input'),
                    valor = $.trim($(this).val());

            if (valor) {

                $.post('functions.php', {type: 'edit', action: 'vLogin', 'login': valor}, function(ret) {
                    if (ret.result == 'ok') {
                        $msg.fadeOut(300).parent().children('input').addClass(ret.result);
                        $input.addClass('ok');
                    } else {
                        $msg.fadeIn(300).children('span:eq(0)').text(ret.result);
                        $input.removeClass('ok');
                    }
                }, 'jSON');

            } else {
                $msg.fadeIn(300).children('span:eq(0)').text('Insira um login!');
                $input.removeClass('ok');
            }
        });

        $('#template-cadastro').submit(function(e) {
            var $this = $(this),
                    $msg = $this.children('div').children('.template-cadastro-msg'),
                    $input = $this.children('div').children('input'),
                    //
                    login = $input.eq(0),
                    //
                    login_val = $.trim($input.eq(0).val());

            if (!login_val || !login.hasClass('ok')) {
                login.focus();
                $msg.hide().eq(1).fadeIn(300);

            } else {
                return true;
            }

            e.preventDefault();
        });

        if (window.File && window.FileReader && window.FileList && window.Blob) {
            function handleFileSelect(evt) {
                var files = evt.target.files,
                        file = files[0];

                if (file.type.match('image.*')) {
                    var reader = new FileReader();

                    reader.onload = (function(theFile) {
                        return function(e) {
                            $('#template-cadastro-imagem').hide().fadeIn(600).css('background-image', 'url("' + e.target.result + '")');
                        };
                    })(file);

                    reader.readAsDataURL(file);

                } else {
                    alert('Somente imagens!');
                }
            }

            document.getElementById('img').addEventListener('change', handleFileSelect, false);
        }

    });
</script>

<div id="template">

    <p style="padding-top:20px;text-align:center;font-size:30px;font-weight:bold;color:#555;display:block;">
        Olá, <?php echo ucwords($user->getNome()); ?>!
    </p>

    <p style="padding-top:20px;text-align:center;font-size:15px;color:#555;display:block;">
        Precisamos de alguns dados ;)
    </p>

    <form action="" method="post" enctype="multipart/form-data" id="template-cadastro">

        <div id="template-cadastro-imagem"></div>

        <div class="template-cadastro-input">
            <label for="nomeUsuario">Nome de Usuario:</label>
            <input type="text" name="nomeUsuario" placeholder="Nome de Usuario" maxlength="20" value="<?php echo (isset($_POST['login']) ? $_POST['login'] : ''); ?>">
            <div class="template-cadastro-msg"> <span>Insira um Nome de Usuario!</span> <span></span> </div>
        </div>

        <div class="template-cadastro-input">
            <label for="login">Imagem:</label>
            <input type="file" name="img" id="img">
        </div>

        <div> <?php echo (isset($erro) ? $erro : ''); ?> </div>

        <button name="salvar">Salvar</button>
    </form>

</div>

<?php include('partes/rodape.php'); ?>