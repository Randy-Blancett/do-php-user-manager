Ext.define('darkowl.desktop.module.abs_Module',
{
	// extend : 'Ext.panel.Panel',
	m_obj_Shortcuts : null,
	m_str_Name : 'default',
	getName : function ()
	{
		return this.m_str_Name;
	},
	getShortcuts : function ()
	{
		return this.m_obj_Shortcuts;
	},
	getStartMenu : function ()
	{
		return {};
	}
});