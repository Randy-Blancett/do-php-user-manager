Ext
		.define(
				'darkowl.userManager.eventManager.cStartMenuEvents',
				{
					singleton : true,
					alternateClassName : [ 'startMenu.MsgBus' ],
					extend : 'Ext.util.Observable',
					requires : [ 'darkowl.desktop.util.cLogger',
							'darkowl.desktop.eventManager.cDesktopEvents',
							'darkowl.userManager.eventManager.cWorkFlowEvents' ],
					statics : {
						C_STR_EVENT_OPEN_ACTION_ADD : "doopenactionadd",
						C_STR_EVENT_OPEN_ACTION_EDIT : "doopenactionedit",
						C_STR_EVENT_OPEN_ACTION_DELETE : "doopenactiondelete",
						C_STR_EVENT_OPEN_ACTION_VIEW : "doopenactionview",
						C_STR_EVENT_OPEN_APP_ADD : "doopenappadd",
						C_STR_EVENT_OPEN_APP_EDIT : "doopenappedit",
						C_STR_EVENT_OPEN_APP_DELETE : "doopenappdelete",
						C_STR_EVENT_OPEN_APP_VIEW : "doopenappview",
						C_STR_EVENT_OPEN_GROUP_ADD : "doopengroupadd",
						C_STR_EVENT_OPEN_GROUP_EDIT : "doopengroupedit",
						C_STR_EVENT_OPEN_GROUP_DELETE : "doopengroupdelete",
						C_STR_EVENT_OPEN_GROUP_VIEW : "doopengroupview",
						C_STR_EVENT_OPEN_USER_ADD : "doopenuseradd",
						C_STR_EVENT_OPEN_USER_VIEW : "doopenuserview"
					},
					constructor : function(config) {
						this.callParent(arguments);
						this.addMsgEvents();
					},

					addMsgEvents : function() {
						this.addEvents(this.self.C_STR_EVENT_OPEN_ACTION_ADD,
								this.self.C_STR_EVENT_OPEN_ACTION_EDIT,
								this.self.C_STR_EVENT_OPEN_ACTION_DELETE,
								this.self.C_STR_EVENT_OPEN_ACTION_VIEW,
								this.self.C_STR_EVENT_OPEN_APP_ADD,
								this.self.C_STR_EVENT_OPEN_APP_EDIT,
								this.self.C_STR_EVENT_OPEN_APP_DELETE,
								this.self.C_STR_EVENT_OPEN_APP_VIEW,
								this.self.C_STR_EVENT_OPEN_GROUP_ADD,
								this.self.C_STR_EVENT_OPEN_GROUP_EDIT,
								this.self.C_STR_EVENT_OPEN_GROUP_DELETE,
								this.self.C_STR_EVENT_OPEN_GROUP_VIEW,
								this.self.C_STR_EVENT_OPEN_USER_ADD,
								this.self.C_STR_EVENT_OPEN_USER_VIEW);

						this.on(this.self.C_STR_EVENT_OPEN_ACTION_ADD,
								this.openActionAdd);
						this.on(this.self.C_STR_EVENT_OPEN_ACTION_EDIT,
								this.openActionEdit);
						this.on(this.self.C_STR_EVENT_OPEN_ACTION_DELETE,
								this.openActionDelete);
						this.on(this.self.C_STR_EVENT_OPEN_ACTION_VIEW,
								this.openActionView);

						this.on(this.self.C_STR_EVENT_OPEN_APP_ADD,
								this.openAppAdd);
						this.on(this.self.C_STR_EVENT_OPEN_APP_EDIT,
								this.openAppEdit);
						this.on(this.self.C_STR_EVENT_OPEN_APP_DELETE,
								this.openAppDelete);
						this.on(this.self.C_STR_EVENT_OPEN_APP_VIEW,
								this.openAppView);

						this.on(this.self.C_STR_EVENT_OPEN_GROUP_ADD,
								this.openGroupAdd);
						this.on(this.self.C_STR_EVENT_OPEN_GROUP_EDIT,
								this.openGroupEdit);
						this.on(this.self.C_STR_EVENT_OPEN_GROUP_DELETE,
								this.openGroupDelete);
						this.on(this.self.C_STR_EVENT_OPEN_GROUP_VIEW,
								this.openGroupView);

						this.on(this.self.C_STR_EVENT_OPEN_USER_ADD,
								this.openUserAdd);
						this.on(this.self.C_STR_EVENT_OPEN_USER_VIEW,
								this.openUserView);
					},
					fireEvent : function() {
						// desktop.logger.log(arguments);
						// darkowl.desktop.eventManager.cDesktopEvents.fireEvent(arguments);
						this.callParent(arguments);
					},
					openActionView : function() {
						desktop.MsgBus.fireEvent(
								desktop.MsgBus.self.C_STR_EVENT_OPEN_WINDOW,
								{}, 'darkowl.userManager.action.view.cWindow');
					},
					openActionAdd : function() {
						desktop.MsgBus
								.fireEvent(
										desktop.MsgBus.self.C_STR_EVENT_OPEN_WINDOW,
										{
											title : "Add Action",
											iconCls : "window-action-add-icon"
										},
										'darkowl.userManager.action.addEdit.cWindow');
					},
					openActionEdit : function(str_Action) {
						if (!str_Action) {
							this.openActionAdd();
						} else {
							desktop.MsgBus
									.fireEvent(
											desktop.MsgBus.self.C_STR_EVENT_OPEN_WINDOW,
											{
												title : "Edit Action",
												iconCls : "window-action-edit-icon",
												m_str_ID : str_Action
											},
											'darkowl.userManager.action.addEdit.cWindow');
						}
					},
					openActionDelete : function(str_Action) {
						console.log("Delete - " + str_Action);
						var obj_Connection = Ext.create("Ext.data.Connection");

						obj_Connection
								.request({
									url : '../rest/action/' + str_Action,
									method : 'DELETE',
									params : {
										"id" : str_Action
									},
									success : function(obj_Response, obj_Arg) {
										var obj_JSON = Ext
												.decode(obj_Response.responseText);
										if (obj_JSON.success) {
											userManager.MsgBus
													.fireEvent(userManager.MsgBus.self.C_STR_EVENT_ACTION_DELETED);
										} else {
											Ext.MessageBox
													.alert(
															"Delete Error",
															"Failed to delete Action",
															function() {
																Console
																		.log("Failed to Delete Action");
															});

										}
										console.log("Deleted Object");
									},
									failure : function() {
										console.log("Failed to Delete Object");
									}
								});

					},
					openAppView : function() {
						desktop.MsgBus.fireEvent(
								desktop.MsgBus.self.C_STR_EVENT_OPEN_WINDOW,
								{},
								'darkowl.userManager.application.view.cWindow');
					},
					openAppAdd : function() {
						desktop.MsgBus
								.fireEvent(
										desktop.MsgBus.self.C_STR_EVENT_OPEN_WINDOW,
										{
											title : "Add Application",
											iconCls : "window-application-add-icon"
										},
										'darkowl.userManager.application.addEdit.cWindow');
					},
					openAppEdit : function(str_App) {
						if (!str_App) {
							this.openAppAdd();
						} else {
							desktop.MsgBus
									.fireEvent(
											desktop.MsgBus.self.C_STR_EVENT_OPEN_WINDOW,
											{
												title : "Edit Application",
												iconCls : "window-application-edit-icon",
												m_str_ID : str_App
											},
											'darkowl.userManager.application.addEdit.cWindow');
						}
					},
					openAppDelete : function(str_App) {
						console.log("Delete - " + str_App);
						var obj_Connection = Ext.create("Ext.data.Connection");

						obj_Connection
								.request({
									url : '../rest/application/' + str_App,
									method : 'DELETE',
									params : {
										"id" : str_App
									},
									success : function(obj_Response, obj_Arg) {
										var obj_JSON = Ext
												.decode(obj_Response.responseText);
										if (obj_JSON.success) {
											userManager.MsgBus
													.fireEvent(userManager.MsgBus.self.C_STR_EVENT_APPLICATION_DELETED);
										} else {
											Ext.MessageBox
													.alert(
															"Delete Error",
															"Failed to delete Application",
															function() {
																Console
																		.log("Failed to Delete Application");
															});

										}
										console.log("Deleted Object");
									},
									failure : function() {
										console.log("Failed to Delete Object");
									}
								});
					},
					openGroupView : function() {
						desktop.MsgBus.fireEvent(
								desktop.MsgBus.self.C_STR_EVENT_OPEN_WINDOW,
								{}, 'darkowl.userManager.group.view.cWindow');
					},
					openGroupEdit : function(str_Group) {
						if (!str_Group) {
							this.openGroupAdd();
						} else {
							desktop.MsgBus
									.fireEvent(
											desktop.MsgBus.self.C_STR_EVENT_OPEN_WINDOW,
											{
												title : "Edit Group",
												iconCls : "window-group-edit-icon",
												m_str_ID : str_Group
											},
											'darkowl.userManager.group.addEdit.cWindow');
						}
					},
					openGroupDelete : function(str_Group) {
						desktop.logger.log("Delete - " + str_Group);
						var obj_Connection = Ext.create("Ext.data.Connection");

						obj_Connection
								.request({
									url : '../rest/group/' + str_Group,
									method : 'DELETE',
									params : {
										"id" : str_Group
									},
									success : function(obj_Response, obj_Arg) {
										var obj_JSON = Ext
												.decode(obj_Response.responseText);
										if (obj_JSON.success) {
											userManager.MsgBus
													.fireEvent(userManager.MsgBus.self.C_STR_EVENT_GROUP_DELETED);
										} else {
											Ext.MessageBox
													.alert(
															"Delete Error",
															"Failed to delete Application",
															function() {
																Console
																		.log("Failed to Delete Group");
															});
										}
									},
									failure : function() {
										console.log("Failed to Delete Object");
									}
								});
					},
					openGroupAdd : function() {
						desktop.MsgBus.fireEvent(
								desktop.MsgBus.self.C_STR_EVENT_OPEN_WINDOW, {
									title : "Add Group",
									iconCls : "window-group-add-icon"
								}, 'darkowl.userManager.group.addEdit.cWindow');
					},
					openUserView : function() {
						desktop.MsgBus.fireEvent(
								desktop.MsgBus.self.C_STR_EVENT_OPEN_WINDOW,
								{}, 'darkowl.userManager.user.view.cWindow');
					},
					openUserAdd : function() {
						desktop.MsgBus.fireEvent(
								desktop.MsgBus.self.C_STR_EVENT_OPEN_WINDOW, {
									title : "Add User",
									iconCls : "window-user-add-icon"
								}, 'darkowl.userManager.user.addEdit.cWindow');
					}
				});