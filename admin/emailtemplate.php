
<!DOCTYPE html>
   <html>
    <head>
       <style type="text/css">
        td{
          padding: 20px;
          font-family: Open Sans;
        }
        td span{
          font-weight: 600;
        }
      </style>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Welcome to {site_name}</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
     
    </head>
    <body>
      <center>
         <table cellspacing="0" style="border: 2px; width: 500px;background: #eee; height: 70px;">
            <tr style="text-align: center;"> 
                <td style="background: #eee; border-bottom: 2px solid #bb342f;"><img src="{base_url}admin/default/images/logo/logo.png" alt="Logo"></td>
              
            </tr>
           
         <tr>
                <td>Hello <span>{username}</span>,</td>
            </tr>
            <tr >
               <td><p>We were told that you forgot your password on {username}.</p>
                
                <p>To reset your password,please click this link: <a>{reset_link}</a></p>
                
               </td>
            </tr>
            <tr>
               <td><p><span>Regard,</span></p>
               <p><span>Together Mentor</span></p></td>
            </tr>
           <tr>
                <td style="background: linear-gradient(to right, #b31217, #e52d27);"><p style="color: #fff; text-align: center;">Copyright © <span>{year}</span> Together Mentor . All Rights Reserved</p></td>
              
            </tr>
           
        </table>
      </center>
    </body>
</html>


