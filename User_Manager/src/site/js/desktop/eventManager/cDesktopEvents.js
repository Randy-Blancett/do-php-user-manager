Ext.define('darkowl.desktop.eventManager.cDesktopEvents',
{
	singleton : true,
	alternateClassName :
	[
		'desktop.MsgBus'
	],
	extend : 'Ext.util.Observable',
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
		this.addMsgEvents();
		this.callParent(arguments);
	},
	
	addMsgEvents : function ()
	{
		this.addEvents(this.self.C_STR_EVENT_LOGOUT);
	},
	fireEvent : function ()
	{
		//desktop.logger.log(arguments);		
		//darkowl.desktop.eventManager.cDesktopEvents.fireEvent(arguments);
		this.callParent(arguments);
	}
});