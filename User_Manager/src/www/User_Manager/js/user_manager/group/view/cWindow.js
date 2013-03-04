Ext
		.define(
				'darkowl.userManager.group.view.cWindow',
				{
					extend : 'darkowl.desktop.cDesktopWindow',
					title : "View Groups",
					requires : [ 'darkowl.userManager.group.view.cToolbar',
							'darkowl.userManager.group.view.cGrid' ],
					iconCls : "window-group-view-icon",
					width : 600,
					height : 480,
					shim : false,
					animCollapse : false,
					constrain : true,
					layout : "fit",
					border : false,
					statics : {
						C_STR_EVENT_EDIT : "doedit",
						C_STR_EVENT_DELETE : "doremove"
					},
					constructor : function(config) {
						this.callParent(arguments);
						this.addMsgEvents();
					},
					addMsgEvents : function() {
						this.addEvents(this.self.C_STR_EVENT_EDIT,
								this.self.C_STR_EVENT_DELETE);

						this.on(this.self.C_STR_EVENT_EDIT, this.editGroup);
						this.on(this.self.C_STR_EVENT_DELETE, this.deleteGroup);
					},
					initComponent : function() {
						var obj_This = this;

						this.m_obj_TopBar = Ext.create(
								'darkowl.userManager.group.view.cToolbar', {
									dock : 'top'
								});

						this.m_obj_Grid = Ext
								.create('darkowl.userManager.group.view.cGrid');

						this.callParent();

						this.addDocked(this.m_obj_TopBar);
						this.add(this.m_obj_Grid);
					},
					editGroup : function() {
						// console.log("Edit Group");
						var arr_Selection = this.m_obj_Grid.getSelectionModel()
								.getSelection();

						switch (arr_Selection.length) {
						case 0:
							Ext.Msg
									.show({
										title : 'Invalid Selection?',
										msg : userManager.dialog.self.C_STR_ERROR_SELECT_ONE,
										buttons : Ext.Msg.OK,
										icon : Ext.Msg.ERROR
									});
							break;
						case 1:
							startMenu.MsgBus
									.fireEvent(
											startMenu.MsgBus.self.C_STR_EVENT_OPEN_GROUP_EDIT,
											arr_Selection[0].get("id"));
							break;
						default:
							Ext.Msg
									.show({
										title : 'Invalid Selection?',
										msg : userManager.dialog.self.C_STR_ERROR_SELECT_ONLY_ONE,
										buttons : Ext.Msg.OK,
										icon : Ext.Msg.ERROR
									});
						}
					},
					deleteGroup : function() {
						var arr_Selection = this.m_obj_Grid.getSelectionModel()
								.getSelection();

						switch (arr_Selection.length) {
						case 0:
							Ext.Msg
									.show({
										title : 'Invalid Selection',
										msg : userManager.dialog.self.C_STR_ERROR_SELECT_ONE,
										buttons : Ext.Msg.OK,
										icon : Ext.Msg.ERROR
									});
							break;
						case 1:
							console.log(arr_Selection[0]);
							Ext.MessageBox
									.confirm(
											userManager.dialog.self.C_STR_DIALOG_CONFIRM_TITLE,
											userManager.dialog.self.C_STR_DIALOG_CONFIRM_DIALOG
													+ "'"
													+ arr_Selection[0].data.name
													+ "'",
											function(obj_Btn) {
												if (obj_Btn.toUpperCase() == "YES") {
													startMenu.MsgBus
															.fireEvent(
																	startMenu.MsgBus.self.C_STR_EVENT_OPEN_GROUP_DELETE,
																	arr_Selection[0]
																			.get("id"));
												}
											});
							break;
						default:
							Ext.Msg
									.show({
										title : 'Invalid Selection',
										msg : userManager.dialog.self.C_STR_ERROR_SELECT_ONLY_ONE,
										buttons : Ext.Msg.OK,
										icon : Ext.Msg.ERROR
									});
						}
					}
				});
