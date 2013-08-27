Ext.define('darkowl.desktop.eventManager.cDesktopEvents', {
	singleton : true,
	alternateClassName : [ 'desktop.MsgBus' ],
	extend : 'Ext.util.Observable',
	requires : [ 'darkowl.desktop.util.cLogger',
			'darkowl.desktop.config.cWindow' ],
	statics : {
		C_STR_EVENT_CONFIGURE : "doopenconfig",
		C_STR_EVENT_LOGOUT : "dologout",
		C_STR_EVENT_OPEN_WINDOW : "doopenwindow"
	},
	constructor : function(config) {
		this.addMsgEvents();
		this.callParent(arguments);

		this.on(this.self.C_STR_EVENT_CONFIGURE, this.openConfigWindow);
	},

	openConfigWindow : function() {
		desktop.MsgBus.fireEvent(desktop.MsgBus.self.C_STR_EVENT_OPEN_WINDOW, {
			title : "Configuration Window",
			iconCls : "window-action-add-icon"
		}, 'darkowl.desktop.config.cWindow');
	},

	addMsgEvents : function() {
		this
				.addEvents(this.self.C_STR_EVENT_CONFIGURE,
						this.self.C_STR_EVENT_LOGOUT,
						this.self.C_STR_EVENT_OPEN_WINDOW);
	},
	fireEvent : function() {
		// desktop.logger.log(arguments);
		// darkowl.desktop.eventManager.cDesktopEvents.fireEvent(arguments);
		this.callParent(arguments);
	}
});