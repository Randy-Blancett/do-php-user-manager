Ext.define('darkowl.userManager.eventManager.cWorkFlowEvents',
{
    singleton : true,
    alternateClassName :
    [ 'userManager.MsgBus' ],
    extend : 'Ext.util.Observable',
    requires :
    [ 'darkowl.desktop.util.cLogger',
            'darkowl.desktop.eventManager.cDesktopEvents',
            'darkowl.userManager.config.cDialog', ],
    statics :
    {
        C_STR_EVENT_ACTION_ADDED : "doactionadded",
        C_STR_EVENT_ACTION_DELETED : "doactiondeleted"
    },
    constructor : function(config)
    {
	    this.callParent(arguments);
	    this.addMsgEvents();
    },

    addMsgEvents : function()
    {
	    this.addEvents(this.self.C_STR_EVENT_ACTION_ADDED,
	            this.self.C_STR_EVENT_ACTION_DELETED);

	    this.on(this.self.C_STR_EVENT_ACTION_ADDED, this.doActionAdded);
	    this.on(this.self.C_STR_EVENT_ACTION_DELETED, this.doActionDelete);
    },
    fireEvent : function()
    {
	    this.callParent(arguments);
    },
    doActionAdded : function()
    {
	    Ext.Msg.alert(userManager.dialog.self.C_STR_DIALOG_SUCCESS_TITLE,
	            userManager.dialog.self.C_STR_ACTION_SAVE_SUCCESS);
    },
    doActionDelete : function()
    {
	    Ext.Msg.alert(userManager.dialog.self.C_STR_DIALOG_SUCCESS_TITLE,
	            userManager.dialog.self.C_STR_ACTION_DELETE_SUCCESS);
    }

});