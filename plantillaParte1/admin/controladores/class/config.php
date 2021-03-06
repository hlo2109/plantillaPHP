<?php 
    class config{
        static $db;
        function __construct(){
            global $dba;
            self::$db = $dba;
            $this->validate_profile();

        }
        
        function pass($data){
            return password_hash($data, PASSWORD_BCRYPT);
        }

        function validator(){
            global $validator;
            return $validator;
        }

        function very_pass($anterior, $data){           
            return (password_verify($data, $anterior))?true:false;
        }

        function message($data, $type=true){ 
            if($type){
                $_SESSION["admin"]["success"] = $data;
            } else{
                $_SESSION["admin"]["error"] = $data;
            }
        }
        function messageSuccess(){
            $error = (isset($_SESSION["admin"]["success"]))? $_SESSION["admin"]["success"]:null;
            unset($_SESSION["admin"]["success"]);
            return $error;
        }
        function messageError(){
            $error = (isset($_SESSION["admin"]["error"]))?$_SESSION["admin"]["error"]:null; 
            unset($_SESSION["admin"]["error"]);
            return $error;
        }

        function validateEmail($email){
            return (1 === preg_match("/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/", $email, $matches));
        }  
        function menu_profile($file){            
            $data = self::$db->select("menu_profile(mp)",
                    [
                        "[><]menus(m)"=>["mp.id_menu"=>"id"]
                    ],
                    ["m.name","m.page"],
                    [
                        "m.page"=>$file,
                        "mp.id_profile"=>$_SESSION["admin"]["profile"]
                    ]
            );
            return $data;
        }
        function validate_profile(){
            $_SESSION["admin"]["profile"] = isset($_SESSION["admin"]["profile"])?$_SESSION["admin"]["profile"]:'';
            $file = explode("/", $_SERVER['PHP_SELF']);
            $file = end($file);
            if($file != 'iniciar_sesion.php' && $file != 'recuperar_contrasenia.php' && $file != 'ajax_admin.php'){
                $data = $this->menu_profile($file);
                if($data){
                    
                } else{
                    header("location: iniciar_sesion.php");
                }
            }
        }

        function sendEmail($to,$subject,$mensaje){
            $OB="----=_OuterBoundary_000";
            $headers ="MIME-Version: 1.0\r\n";
            $headers.="From: hlo21.com <dev@hlo21.com>\n";
            // $headers.="To: ".$destino." <".$destino.">\n";
            // $headers.="X-Priority: 1\n";
            // $headers.="X-MSMail-Priority: High\n";
            $headers.="X-Mailer: My PHP Mailer\n";
            $headers.="Content-Type: text/html;\n\t charset=utf-8\r\n boundary=\"".$OB."\"\n";
            return mail($to, $subject, $mensaje, $headers);
        }

    }
    $config = new config();
?>