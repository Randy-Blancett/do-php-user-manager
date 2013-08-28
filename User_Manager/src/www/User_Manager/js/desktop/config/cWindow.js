Ext.define('darkowl.desktop.config.cWindow', {
	extend : 'darkowl.desktop.cDesktopWindow',
	title : "View Actions",
	requires : [],
	iconCls : "window-action-view-icon",
	width : 600,
	height : 480,
	shim : false,
	animCollapse : false,
	constrain : true,
	layout : "fit",
	border : false,
	constructor : function(config) {
		this.callParent(arguments);
		this.addMsgEvents();
	},

	addMsgEvents : function() {
		// this.addEvents(this.self.C_STR_EVENT_EDIT,
		// this.self.C_STR_EVENT_DELETE);
		// this.on(this.self.C_STR_EVENT_EDIT, this.editAction);
		// this
		// .on(this.self.C_STR_EVENT_DELETE,
		// this.deleteAction);
	},
	initComponent : function() {
		var obj_This = this;
		this.callParent();
	}

});
