Ext
		.define(
				'darkowl.userManager.user.addEdit.tabs.cGroups',
				{
					extend : 'Ext.form.Panel',
					closable : false,
					title : 'Groups',
					requires : [ 'darkowl.userManager.model.cGroup',
							'darkowl.userManager.eventManager.cWorkFlowEvents' ],
					tooltip : 'Groups user has access to.',
					layout : {
						type : 'hbox',
						align : 'stretch'
					},
					statics : {
						C_STR_EVENT_ADD_ALL : "doaddall",
						C_STR_EVENT_ADD_GROUP : "doaddgroup",
						C_STR_EVENT_REMOVE_ALL : "doremoveall",
						C_STR_EVENT_ADD_GROUP : "doremovegroup"
					},
					initComponent : function() {
						var obj_This = this;

						this.addEvents(this.self.C_STR_EVENT_ADD_ALL,
								this.self.C_STR_EVENT_ADD_GROUP,
								this.self.C_STR_EVENT_REMOVE_ALL,
								this.self.C_STR_EVENT_ADD_GROUP);

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
								dataIndex : 'name',
								flex : 1
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
								dataIndex : 'name',
								flex : 1
							} ]
						});

						this.callParent();
						this.add(this.m_obj_AvailGrid);
						this.add(this.m_obj_Control);
						this.add(this.m_obj_CurGrid);

						this.on(this.self.C_STR_EVENT_ADD_ALL, this.doAddAll,
								this);

						this.m_obj_AvailStore.on("load", this.loadAvailStore,
								this);
						this.m_obj_CurStore.on("load", this.loadCurStore, this);

						userManager.MsgBus
								.on(
										userManager.MsgBus.self.C_STR_EVENT_USER_GROUP_REFRESH,
										this.reload, this);
						// this.on(this.self.C_STR_EVENT_ADD_GROUP, this.doAdd,
						// this);
						this.on(this.self.C_STR_EVENT_REMOVE_ALL,
								this.doRemoveAll, this);
						// this.on(this.self.C_STR_EVENT_REMOVE_GROUP,
						// this.doRemove, this);
					},
					loadUser : function(str_ID) {
						this.m_obj_CurStore.getProxy().url = "../rest/user/"
								+ str_ID + "/groups/current";

						this.m_obj_AvailStore.getProxy().url = "../rest/user/"
								+ str_ID + "/groups/available";

						this.m_str_UserID = str_ID;
						this.reload();
					},
					loadAvailStore : function(obj_Store, obj_Record,
							arr_Records, bool_Successful, obj_Opts) {
						this.m_obj_Control
								.setAddAllButton(this.m_obj_AvailStore
										.getCount() > 0);
					},
					loadCurStore : function(obj_Store, obj_Record, arr_Records,
							bool_Successful, obj_Opts) {
						this.m_obj_Control.setRemoveAllButton(obj_Store
								.getCount() > 0);
					},
					reload : function() {
						this.m_obj_AvailStore.load();
						this.m_obj_CurStore.load();

					},
					doAddAll : function() {
						this.m_obj_AvailStore
								.each(
										function(obj_Record) {
											Ext.Ajax
													.request({
														headers : {
															Accept : "application/json"
														},
														url : "../rest/user/"
																+ this.m_str_UserID
																+ "/groups/"
																+ obj_Record
																		.get("id"),
														method : "PUT",
														success : function(
																obj_Response) {
															userManager.MsgBus
																	.fireEvent(userManager.MsgBus.self.C_STR_EVENT_USER_GROUP_REFRESH);
														},
														failure : function(
																obj_Response,
																obj_Opts) {
															userManager.MsgBus
																	.fireEvent(userManager.MsgBus.self.C_STR_EVENT_USER_GROUP_REFRESH);
														}
													});
										}, this);
					},
					// doAdd : function() {
					// alert("Add Group");
					// },
					doRemoveAll : function() {
						this.m_obj_CurStore
								.each(
										function(obj_Record) {
											console.log("Remove Group "
													+ obj_Record.get("id"));
											Ext.Ajax
													.request({
														headers : {
															Accept : "application/json"
														},
														url : "../rest/user/"
																+ this.m_str_UserID
																+ "/groups/"
																+ obj_Record
																		.get("id"),
														method : "DELETE",
														success : function(
																obj_Response) {
															console
																	.log("Success Group REmove All");
															userManager.MsgBus
																	.fireEvent(userManager.MsgBus.self.C_STR_EVENT_USER_GROUP_REFRESH);
														},
														failure : function(
																obj_Response,
																obj_Opts) {
															userManager.MsgBus
																	.fireEvent(userManager.MsgBus.self.C_STR_EVENT_USER_GROUP_REFRESH);
															console
																	.log('server-side failure with status code '
																			+ obj_Response.status);
														}
													});
										}, this);
					}
				// ,
				// doRemove : function() {
				// alert("Remove Group");
				// }
				});

Ext
		.define(
				'darkowl.userManager.user.addEdit.tabs.cGroups.cControl',
				{
					extend : 'Ext.panel.Panel',
					width : 115,
					frame : true,
					initComponent : function() {
						var obj_This = this;
						this.m_obj_AddAll = Ext
								.create(
										'Ext.button.Button',
										{
											text : "Add All -->",
											width : 100,
											handler : function() {
												this
														.up("panel")
														.up("panel")
														.fireEvent(
																darkowl.userManager.user.addEdit.tabs.cGroups.C_STR_EVENT_ADD_ALL);
											}
										});
						this.m_obj_RemoveAll = Ext
								.create(
										'Ext.button.Button',
										{
											text : "<-- Remove All",
											width : 100,
											handler : function() {
												this
														.up("panel")
														.up("panel")
														.fireEvent(
																darkowl.userManager.user.addEdit.tabs.cGroups.C_STR_EVENT_REMOVE_ALL);
											}
										});
						this.callParent();
						this.add(this.m_obj_AddAll, this.m_obj_RemoveAll);
						this.disable();
					},
					setAddAllButton : function(bool_Enable) {
						if (bool_Enable) {
							this.m_obj_AddAll.enable();
						} else {
							this.m_obj_AddAll.disable();
						}
					},
					setRemoveAllButton : function(bool_Enable) {
						if (bool_Enable) {
							this.m_obj_RemoveAll.enable();
						} else {
							this.m_obj_RemoveAll.disable();
						}
					},
					disable : function() {
						this.m_obj_AddAll.disable();
					},
					enable : function() {
						this.m_obj_AddAll.enable();
					}
				});