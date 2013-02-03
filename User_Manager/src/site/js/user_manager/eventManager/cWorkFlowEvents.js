Ext.define('darkowl.userManager.eventManager.cWorkFlowEvents', {
	singleton : true,
	alternateClassName : [ 'userManager.MsgBus' ],
	extend : 'Ext.util.Observable',
	requires : [ 'darkowl.desktop.util.cLogger',
			'darkowl.desktop.eventManager.cDesktopEvents',
			'darkowl.userManager.config.cDialog', ],
	statics : {
		C_STR_EVENT_ACTION_ADDED : "doactionadded",
		C_STR_EVENT_ACTION_DELETED : "doactiondeleted",
		C_STR_EVENT_APPLICATION_ADDED : "doapplicationadded",
		C_STR_EVENT_APPLICATION_DELETED : "doapplicationdeleted",
		C_STR_EVENT_GROUP_ADDED : "dogroupadded",
		C_STR_EVENT_GROUP_DELETED : "dogroupdeleted",
		C_STR_EVENT_USER_ADDED : "douseradded",
		C_STR_EVENT_USER_DELETED : "douserdeleted",
		C_STR_EVENT_USER_GROUP_ADDED : "dousergroupadded",
		C_STR_EVENT_USER_GROUP_DELETED : "dousergroupdeleted",
		C_STR_EVENT_USER_GROUP_REFRESH : "dousergrouprefresh"
	},
	constructor : function(config) {
		this.callParent(arguments);
		this.addMsgEvents();
	},

	addMsgEvents : function() {
		this.addEvents(this.self.C_STR_EVENT_ACTION_ADDED,
				this.self.C_STR_EVENT_ACTION_DELETED,
				this.self.C_STR_EVENT_APPLICATION_ADDED,
				this.self.C_STR_EVENT_APPLICATION_DELETED,
				this.self.C_STR_EVENT_GROUP_ADDED,
				this.self.C_STR_EVENT_GROUP_DELETED,
				this.self.C_STR_EVENT_USER_ADDED,
				this.self.C_STR_EVENT_USER_DELETED,
				this.self.C_STR_EVENT_USER_GROUP_ADDED,
				this.self.C_STR_EVENT_USER_GROUP_DELETED,
				this.self.C_STR_EVENT_USER_GROUP_REFRESH);

		this.on(this.self.C_STR_EVENT_ACTION_ADDED, this.doActionAdded);
		this.on(this.self.C_STR_EVENT_ACTION_DELETED, this.doActionDelete);

		this.on(this.self.C_STR_EVENT_APPLICATION_ADDED,
				this.doApplicationAdded);
		this.on(this.self.C_STR_EVENT_APPLICATION_DELETED,
				this.doApplicationDelete);

		this.on(this.self.C_STR_EVENT_GROUP_ADDED, this.doGroupAdded);
		this.on(this.self.C_STR_EVENT_GROUP_DELETED, this.doGroupDelete);

		this.on(this.self.C_STR_EVENT_USER_ADDED, this.doUserAdded);
		this.on(this.self.C_STR_EVENT_USER_DELETED, this.doUserDelete);
	},
	doActionAdded : function() {
		Ext.Msg.alert(userManager.dialog.self.C_STR_DIALOG_SUCCESS_TITLE,
				userManager.dialog.self.C_STR_ACTION_SAVE_SUCCESS);
	},
	doActionDelete : function() {
		Ext.Msg.alert(userManager.dialog.self.C_STR_DIALOG_SUCCESS_TITLE,
				userManager.dialog.self.C_STR_ACTION_DELETE_SUCCESS);
	},
	doApplicationAdded : function() {
		Ext.Msg.alert(userManager.dialog.self.C_STR_DIALOG_SUCCESS_TITLE,
				userManager.dialog.self.C_STR_APPLICATION_SAVE_SUCCESS);
	},
	doApplicationDelete : function() {
		Ext.Msg.alert(userManager.dialog.self.C_STR_DIALOG_SUCCESS_TITLE,
				userManager.dialog.self.C_STR_APPLICATION_DELETE_SUCCESS);
	},
	doGroupAdded : function() {
		Ext.Msg.alert(userManager.dialog.self.C_STR_DIALOG_SUCCESS_TITLE,
				userManager.dialog.self.C_STR_GROUP_SAVE_SUCCESS);
	},
	doGroupDelete : function() {
		Ext.Msg.alert(userManager.dialog.self.C_STR_DIALOG_SUCCESS_TITLE,
				userManager.dialog.self.C_STR_GROUP_DELETE_SUCCESS);
	},
	doUserAdded : function() {
		Ext.Msg.alert(userManager.dialog.self.C_STR_DIALOG_SUCCESS_TITLE,
				userManager.dialog.self.C_STR_USER_SAVE_SUCCESS);
	},
	doUserDelete : function() {
		Ext.Msg.alert(userManager.dialog.self.C_STR_DIALOG_SUCCESS_TITLE,
				userManager.dialog.self.C_STR_USER_DELETE_SUCCESS);
	}

});