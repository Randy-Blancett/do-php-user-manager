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
        C_STR_EVENT_ACTION_DELETED : "doactiondeleted",
        C_STR_EVENT_APPLICATION_ADDED : "doapplicationadded",
        C_STR_EVENT_APPLICATION_DELETED : "doapplicationdeleted"
    },
    constructor : function(config)
    {
	    this.callParent(arguments);
	    this.addMsgEvents();
    },

    addMsgEvents : function()
    {
	    this.addEvents(this.self.C_STR_EVENT_ACTION_ADDED,
	            this.self.C_STR_EVENT_ACTION_DELETED,
	            this.self.C_STR_EVENT_APPLICATION_ADDED,
	            this.self.C_STR_EVENT_APPLICATION_DELETED);

	    this.on(this.self.C_STR_EVENT_ACTION_ADDED, this.doActionAdded);
	    this.on(this.self.C_STR_EVENT_ACTION_DELETED, this.doActionDelete);

	    this.on(this.self.C_STR_EVENT_APPLICATION_ADDED,
	            this.doApplicationAdded);
	    this.on(this.self.C_STR_EVENT_APPLICATION_DELETED,
	            this.doApplicationDelete);
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
    },
    doApplicationAdded : function()
    {
	    Ext.Msg.alert(userManager.dialog.self.C_STR_DIALOG_SUCCESS_TITLE,
	            userManager.dialog.self.C_STR_APPLICATION_SAVE_SUCCESS);
    },
    doApplicationDelete : function()
    {
	    Ext.Msg.alert(userManager.dialog.self.C_STR_DIALOG_SUCCESS_TITLE,
	            userManager.dialog.self.C_STR_APPLICATION_DELETE_SUCCESS);
    }

});