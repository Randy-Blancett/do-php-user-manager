Ext.Loader.setConfig({
	enabled : true
});
Ext.Loader.setPath("darkowl.userManager", '../js/user_manager', "js");
Ext.Loader.setPath("darkowl.desktop", '../js/desktop', "js");
// Ext.Loader.setPath("plugin",'JS/plugin',"php");
Ext.Loader.setPath("Ext", g_obj_Config.m_str_ExtJs4Path + '/src', "js");

Ext.require('Ext.tip.QuickTipManager');
Ext.require('darkowl.desktop.cApplication');

// Ext.require("darkowl.userManager.module.desktop", null, null, null, "js");
Ext.onReady(Setup);

function Setup() {
	Ext.tip.QuickTipManager.init();
	m_obj_UserManager_App = Ext.create('darkowl.desktop.cApplication', {
		renderTo : Ext.getBody()
	});

	Ext.apply(Ext.form.field.VTypes, {
		password : function(obj_Val, obj_Field) {
			if (obj_Field.initialPassField) {
				return (obj_Val == obj_Field.initialPassField.getValue());
			}
			return true;
		},
		passwordText : 'The confirmation password does not match the original.'
	});

	var obj_Desktop = Ext.create('darkowl.userManager.module.desktop');

	m_obj_UserManager_App.addModule(obj_Desktop);
	// m_obj_UserManager_App.addModule(Ext.create('darkowl.desktop.module.cExample'));

	// m_obj_UserManager_App = darkowl.desktop.cApplication;
	// m_obj_UserManager_App.render(Ext.getBody());
	darkowl.desktop.config.cConfig.setUserName(g_obj_Config.m_str_UserName);
	darkowl.desktop.config.cConfig.setLogoutURL(g_obj_Config.m_str_LogoutURL);
}