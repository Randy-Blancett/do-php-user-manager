Ext.define('darkowl.desktop.eventManager.cDesktopEvents',
{
	singleton : true,
	extend : 'Ext.AbstractComponent',
	m_obj_MsgBus : null,
	requires :
	[
		'darkowl.desktop.util.cLogger'
	],
	statics :
	{
		C_STR_EVENT_LOGOUT : "dologout"
	},
	constructor : function (config)
	{
		darkowl.desktop.util.cLogger.log("test");
		darkowl.desktop.util.cLogger.log(this);
	},
	
	addMsgEvents : function ()
	{
		if (!this.m_obj_MsgBus)
		{
			return;
		}
		this.m_obj_MsgBus.addEvents(this.self.C_STR_EVENT_LOGOUT);
		
		//this.m_obj_MsgBus.on(this.self.C_STR_EVENT_LOGOUT, obj_This.doLogout);
	},
	
	setMsgBus : function (obj_MsgBus)
	{
		this.m_obj_MsgBus = obj_MsgBus;
	}

});