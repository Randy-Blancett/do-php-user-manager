Ext
		.define(
				'darkowl.userManager.user.addEdit.tabs.cGroups',
				{
					extend : 'Ext.form.Panel',
					closable : false,
					title : 'Groups',
					requires : [ 'darkowl.userManager.model.cGroup' ],
					tooltip : 'Groups user has access to.',
					layout : {
						type : 'hbox',
						align : 'stretch'
					},
					initComponent : function() {
						var obj_This = this;

						this.m_obj_AvailStore = Ext.create('Ext.data.Store', {
							proxy : {
								headers : {
									Accept : "application/json"
								},
								type : 'ajax',
								url : '../rest/group',
								reader : {
									totalProperty : 'total',
									type : 'json',
									root : 'groups'
								}
							},
							model : 'darkowl.userManager.model.cGroup'
						});

						this.m_obj_CurStore = Ext.create('Ext.data.Store', {
							proxy : {
								headers : {
									Accept : "application/json"
								},
								type : 'ajax',
								url : '../rest/group',
								reader : {
									totalProperty : 'total',
									type : 'json',
									root : 'groups'
								}
							},
							model : 'darkowl.userManager.model.cGroup'
						});

						this.m_obj_AvailGrid = Ext.create('Ext.grid.Panel', {
							title : 'Available Groups',
							store : this.m_obj_AvailStore,
							flex : 1,
							columns : [ {
								text : 'Name',
								dataIndex : 'name'
							} ]
						});

						this.m_obj_Control = Ext
								.create('darkowl.userManager.user.addEdit.tabs.cGroups.cControl');

						this.m_obj_CurGrid = Ext.create('Ext.grid.Panel', {
							title : 'Current Groups',
							store : this.m_obj_CurStore,
							flex : 1,
							columns : [ {
								text : 'Name',
								dataIndex : 'name'
							} ]
						});

						this.callParent();
						this.add(this.m_obj_AvailGrid);
						this.add(this.m_obj_Control);
						this.add(this.m_obj_CurGrid);

						this.m_obj_AvailStore.load();
						this.m_obj_CurStore.load();
					}
				});

Ext.define('darkowl.userManager.user.addEdit.tabs.cGroups.cControl', {
	extend : 'Ext.panel.Panel',
	width : 100,
	frame : true,
	initComponent : function() {
		var obj_This = this;
		this.m_obj_AddAll = Ext.create('Ext.button.Button', {
			text : "Add All -->",
			width : 100,
			handler : function() {
				alert("Test Button");
			}
		});
		this.callParent();
		this.add(this.m_obj_AddAll);
	}
});