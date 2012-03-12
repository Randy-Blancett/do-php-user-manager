<?php
	use \darkowl\user_manager\webpage;
	/**
	 * Include Default Path Info
	 */
	require_once (dirname(__DIR__)) . "/conf/cInfo.php";
	/**
	 * Include User Validation Class
	 */
//	require_once webpage\cInfo::c_Path2UserManagerCode . "/Classes/cUserValidation.php";
	/**
	 * Include Permission Codes
	 */
//	require_once webpage\cInfo::c_Path2UserManagerCode . "/Classes/cPermission.php";

//	$m_obj_UserValidation = new cUserValidation();

	// Check Login Status
//	$m_obj_UserValidation->require_Login(true);

//	if (!$m_obj_UserValidation->check_Permission(cPermission::c_str_UserManager_View))
//	{
//		$m_obj_UserValidation->logout();
//		die("You do not have permision to view this page");
//	}
	
?>
<html>
	<head>
		<title>User Manager</title>	
		
	</head>
	<body>
		<div id="loading-mask"></div> 
   		<div id="loading" > 
   			<div class="title">
   				User Manager
   			</div>
	        <div class="body"> 
				<div  class="icon">
				</div>
	            <div class="msg" id="loading-msg">Loading styles and images...</div> 
	        </div> 
	    </div> 
	    <link rel="stylesheet" type="text/css" href="<?php print(webpage\cInfo::C_STR_EXT4_LIB_PATH);?>/resources/css/ext-all.css">
	    <link rel="stylesheet" type="text/css" href="../css/main.php" />
	    <link rel="stylesheet" type="text/css" href="../css/icons.php" />
	    
	    <script type="text/javascript">
	    	document.getElementById('loading-msg').innerHTML = 'Loading Core API...';
	    </script> 
	    <script type="text/javascript" src="<?php print(webpage\cInfo::C_STR_EXT4_LIB_PATH);?>/ext.js"></script>
		<script type="text/javascript" src='../js/util/loaderFix.js'></script>
		
	    <script type="text/javascript">
	    	document.getElementById('loading-msg').innerHTML = 'Setting up User Manager ...';
	    </script> 
		
		
		<script language="javascript">

			//EXT Setup
			Ext.Loader.setConfig({enabled:true});
			Ext.tip.QuickTipManager.init();
			Ext.Loader.setPath("DarkOwl.User_Manager",'../js/user_manager',"php");
			//Ext.Loader.setPath("plugin",'JS/plugin',"php");
			//Ext.Loader.setPath("Ext",'<?php print(webpage\cInfo::C_STR_EXT4_LIB_PATH);?>/src',"js");
	
			//Ext.require("DarkOwl.User_Manager.cUserManager_App",null,null,null,"php");
			Ext.onReady(Setup);
	
			function Setup()
			{
//				m_obj_UserManager_App = Ext.create('DarkOwl.User_Manager.cUserManager_App', 
//				{
//		    		renderTo: document.body	
//		    	});
			}
		</script>
	</body>
</html>
