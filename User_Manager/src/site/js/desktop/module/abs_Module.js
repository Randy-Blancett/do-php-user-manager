Ext.define('darkowl.desktop.module.abs_Module',
{
	// extend : 'Ext.panel.Panel',
	statics :
	{
		C_ARR_FIELDS :
		[
				'name', 'iconCls', 'onClick'
		]
	},
	m_obj_Shortcuts : null,
	m_obj_QuickStart : null,
	m_str_Name : 'default',
	getName : function ()
	{
		return this.m_str_Name;
	},
	getShortcuts : function ()
	{
		return this.m_obj_Shortcuts;
	},
	getQuickStart : function ()
	{
		return this.m_obj_QuickStart;
	},
	getStartMenu : function ()
	{
		return {};
	}
});