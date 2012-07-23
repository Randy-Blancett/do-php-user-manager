Ext.define('darkowl.userManager.eventManager.cStartMenuEvents',
{
    singleton : true,
    alternateClassName :
    [ 'startMenu.MsgBus' ],
    extend : 'Ext.util.Observable',
    requires :
    [ 'darkowl.desktop.util.cLogger',
            'darkowl.desktop.eventManager.cDesktopEvents' ],
    statics :
    {
        C_STR_EVENT_OPEN_APP_ADD : "doopenappadd",
        C_STR_EVENT_OPEN_APP_VIEW : "doopenappview",
        C_STR_EVENT_OPEN_USER_ADD : "doopenuseradd",
        C_STR_EVENT_OPEN_USER_VIEW : "doopenuserview"
    },
    constructor : function(config)
    {
	    this.callParent(arguments);
	    this.addMsgEvents();
    },

    addMsgEvents : function()
    {
	    this.addEvents(this.self.C_STR_EVENT_OPEN_APP_ADD,
	            this.self.C_STR_EVENT_OPEN_APP_VIEW,
	            this.self.C_STR_EVENT_OPEN_USER_ADD,
	            this.self.C_STR_EVENT_OPEN_USER_VIEW);

	    this.on(this.self.C_STR_EVENT_OPEN_APP_ADD, this.openAppAdd);
	    this.on(this.self.C_STR_EVENT_OPEN_APP_VIEW, this.openAppView);

	    this.on(this.self.C_STR_EVENT_OPEN_USER_ADD, this.openUserAdd);
	    this.on(this.self.C_STR_EVENT_OPEN_USER_VIEW, this.openUserView);
    },
    fireEvent : function()
    {
	    // desktop.logger.log(arguments);
	    // darkowl.desktop.eventManager.cDesktopEvents.fireEvent(arguments);
	    this.callParent(arguments);
    },
    openAppView : function()
    {
	    desktop.MsgBus.fireEvent(desktop.MsgBus.self.C_STR_EVENT_OPEN_WINDOW,
	            {}, 'darkowl.userManager.application.view.cWindow');
    },
    openAppAdd : function()
    {
	    desktop.logger.log("Opening Application Add.");
    },
    openUserView : function()
    {
	    desktop.MsgBus.fireEvent(desktop.MsgBus.self.C_STR_EVENT_OPEN_WINDOW,
	            {}, 'darkowl.userManager.user.view.cWindow');
    },
    openUserAdd : function()
    {
	    desktop.logger.log("Opening User Add.");
    }
});