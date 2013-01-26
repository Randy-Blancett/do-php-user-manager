Ext.define('darkowl.userManager.user.view.cGrid', {
	extend : 'Ext.grid.Panel',
	requires : [ // 'plugin.grid.cSearch',
	'Ext.toolbar.Paging', 'darkowl.userManager.store.cUserList' ],
	columns : [ {
		header : 'User Name',
		dataIndex : 'userName'
	}, {
		header : 'First Name',
		dataIndex : 'firstName',
		flex : 1
	}, {
		header : 'Last Name',
		dataIndex : 'lastName'
	} ],
	initComponent : function() {
		this.store = Ext.create('darkowl.userManager.store.cUserList');

		this.m_obj_Pageing = Ext.create("Ext.toolbar.Paging", {
			store : this.store,
			dock : 'bottom',
			displayInfo : true
		});

		this.callParent();

		this.on("beforeload", function() {
			this.body.mask('Loading', 'x-mask-loading');
		}, this);

		this.on("load", function() {
			this.body.unmask();
		}, this);

		this.on("itemdblclick", function() {
			this.up("window").fireEvent(
					darkowl.userManager.user.view.cWindow.C_STR_EVENT_EDIT);
		});

		this.addDocked(this.m_obj_Pageing);
	}

});