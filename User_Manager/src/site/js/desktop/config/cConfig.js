Ext.define('darkowl.desktop.config.cConfig',
{
	singleton : true,
	m_str_UserName : '',
	m_str_LogoutURL : '',
	getLogoutURL : function ()
	{
		return this.m_str_LogoutURL;
	},
	getUserName : function ()
	{
		return this.m_str_UserName;
	},
	setLogoutURL : function (str_URL)
	{
		this.m_str_LogoutURL = str_URL;
	},
	setUserName : function (str_UserName)
	{
		this.m_str_UserName = str_UserName;
	}
});