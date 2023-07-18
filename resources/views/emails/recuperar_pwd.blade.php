<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" 
 xmlns:v="urn:schemas-microsoft-com:vml"
 xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- So that mobile will display zoomed in -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- enable media queries for windows phone 8 -->
  <meta name="format-detection" content="date=no"> <!-- disable auto date linking in iOS 7-9 -->
  <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS 7-9 -->
  <title>Sistema de notificaciones iDaves.com</title>
  
  <style type="text/css">
    body {
      margin: 0;
      padding: 0;
      -ms-text-size-adjust: 100%;
      -webkit-text-size-adjust: 100%;
    }

  table {
    border-spacing: 0;
  }

  table td {
    border-collapse: collapse;
  }

  .ExternalClass {
    width: 100%;
  }

  .ExternalClass,
  .ExternalClass p,
  .ExternalClass span,
  .ExternalClass font,
  .ExternalClass td,
  .ExternalClass div {
    line-height: 100%;
  }

  .ReadMsgBody {
    width: 100%;
    background-color: #ebebeb;
  }

  table {
    mso-table-lspace: 0pt;
    mso-table-rspace: 0pt;
  }

  img {
    -ms-interpolation-mode: bicubic;
  }

  .yshortcuts a {
    border-bottom: none !important;
  }

  @media screen and (max-width: 599px) {
    .force-row,
    .container {
      width: 100% !important;
      max-width: 100% !important;
    }
  }
  @media screen and (max-width: 400px) {
    .container-padding {
      padding-left: 12px !important;
      padding-right: 12px !important;
    }
  }
  .ios-footer a {
    color: #aaaaaa !important;
    text-decoration: underline;
  }
  a[href^="x-apple-data-detectors:"],
  a[x-apple-data-detectors] {
    color: inherit !important;
    text-decoration: none !important;
    font-size: inherit !important;
    font-family: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
  }


</style>
</head>

<body style="margin:0; padding:0;" bgcolor="#F0F0F0" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

  <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#F0F0F0">
    <tr>
      <td align="center" valign="top" bgcolor="#F0F0F0" style="background-color: #F0F0F0;">
        <br>
        <table border="0" width="600" cellpadding="0" cellspacing="0" class="container" style="width:600px;max-width:600px">
          <tr>
            <td class="container-padding header" align="left" style="font-family:Helvetica, Arial, sans-serif;font-size:24px;font-weight:bold;padding-bottom:12px;color:#DF4726;padding-left:24px;padding-right:24px">
              <img src="{{asset('assets/media/logos/logo-light.png')}}">
            </td>
          </tr>
          <tr>
            <td class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;background-color:#ffffff">
              <br>

              <div class="title" style="font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:600;color:#374550">Servicio de notificaciones</div>
              <br>

              <div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:justify;color:#333333">
                Estimado(a) <strong>{{ $data[0] }}</strong>,<br>  

                <p align="justify">Hemos recibido una solicitud para restablecer la contraseña de tu cuenta en nuestro sitio web. Si no has hecho esta solicitud, por favor ignora este mensaje y asegúrate de que tu cuenta esté segura.</p>

				        <p align="justify">Si tú hiciste la solicitud, por favor haz clic en el siguiente enlace para restablecer tu contraseña:</p>

                <table style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; vertical-align: top; width: auto !important;"><tbody><tr><td class="button" style="padding: 15px 36px; background: #083f5b; border-collapse: collapse !important; color: #fefefe; font-family: Helvetica,Arial,sans-serif; font-size: 15px; font-weight: bold; hyphens: auto; line-height: 15px; margin: 0; text-align: center; vertical-align: top; word-wrap: break-word;"><a href="{{ env('APP_URL') }}usuarios/recuperar/{{ $data[1] }}" style="color: #ffffff; display: inline-block; text-decoration: none;" target="_blank"> <strong>Recuperar</strong></a></td></tr></tbody></table>

                <br><br>

				        <p align="justify">Si tienes algún problema para acceder a tu cuenta o necesitas ayuda adicional, por favor no dudes en ponerte en contacto con nuestro equipo de soporte.</p>         

              </div>

            </td>
          </tr>
          <tr>
            <td class="container-padding footer-text" align="left" style="font-family:Helvetica, Arial, sans-serif;font-size:12px;line-height:16px;color:#aaaaaa;padding-left:24px;padding-right:24px">
              <br><br> 
              <strong>{{ $empresa[0] }}</strong><br>
              <span class="ios-footer">
                Direcci&oacute;n: {{ $empresa[1] }}<br>
                Tel&eacute;fono: {{ $empresa[2] }}<br>
              </span>
              Email: <a href="mailto:{{ $empresa[3] }}" style="color:#aaaaaa">{{ $empresa[3] }}</a><br>
              <br><br>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>