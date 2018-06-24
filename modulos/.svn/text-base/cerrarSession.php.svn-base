<?php
################################################################################
# Software: Sistema de Helpdesk                                                #
# Version:  1.0                                                                #
# Date:     17-03-2006                                                         #
# Author:   Jose Luis Estevez                                                  #
# License:                                                                     #
# Note:                                                                        #
# Company:  Ministerio de Agriculura y Tierras                                 #
# Web:      www.mat.gob.ve                                                     #
################################################################################

session_destroy();
session_unregister($usuario);
session_unset();
$_SESSION['Usuario'] = null;
$_SESSION['ultimologin'] = null;
echo "<script>location.href='index.php'</script>";
?>