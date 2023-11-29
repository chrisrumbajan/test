<!DOCTYPE html>
    <html>
        <head>
            <style>
                body { 
                    text-align: center; 
                    font-family: sans;
                    padding-top: 15%;
                    background-color: #ffebee;
                }

                @font-face {
                    font-family: 'Philosopher';
                    src: url("<?php echo $this->config->item('resource_url'); ?>font/Philosopher/Philosopher-Regular.ttf");
                }

                #title_app_name {
                    font-family: 'Philosopher';
                    letter-spacing: 0.2em;
                }
            </style>
            <title>404</title>
            <link rel="icon" href="<?php echo $this->config->item('resource_url');?>img/logo-unsrat.png"/>
        </head>
        <body>
            <img src="<?php echo $this->config->item('resource_url').$this->config->item('theme')['app_logo']; ?>"
                width="100em"/>
            <h2 id="title_app_name"><?php echo $this->config->item('theme')['app_name']; ?></h2><br/>
            Waduh, maaf, <br/>terjadi kesalahan atau mungkin halaman yang anda cari tidak ditemukan.<br/><br/>
            <b><i>Redirecting ....</i></b>
        </body>
    </html>

    <script>
        setTimeout(function() {
            window.location.replace("<?php echo base_url(); ?>");
        }, 2000);
    </script>