Ext.define('darkowl.desktop.config.cConfig',
{
	singleton : true,
	m_str_UserName : '',
	getUserName : function ()
	{
		return this.m_str_UserName;
	},
	setUserName : function (str_UserName)
	{
		this.m_str_UserName = str_UserName;
	}
});