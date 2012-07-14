Ext.Loader.setConfig(
{
	enabled : true
});
Ext.Loader.setPath("darkowl.userManager", '../js/user_manager', "js");
// Ext.Loader.setPath("plugin",'JS/plugin',"php");
Ext.Loader.setPath("Ext", g_obj_Config.m_str_ExtJs4Path + '/src', "js");

Ext.require('Ext.tip.QuickTipManager');

// Ext.require("darkowl.userManager.module.desktop", null, null, null, "js");
Ext.onReady(Setup);

function Setup()
{
	Ext.tip.QuickTipManager.init();

	var obj_Login = Ext.create('darkowl.userManager.login.cLoginWin',
	{
		renderTo : document.body
	});

	obj_Login.show();
}