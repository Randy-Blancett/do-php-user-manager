Ext
		.define(
				'darkowl.userManager.group.addEdit.cTopForm',
				{
					extend : 'Ext.form.Panel',
					layout : 'fit',
					m_str_GroupID : "",
					border : false,
					requires : [ 'darkowl.userManager.group.addEdit.cTabForm' ],
					initComponent : function() {
						var obj_This = this;

						this.m_obj_Tabs = Ext
								.create('darkowl.userManager.group.addEdit.cTabForm');

						this.m_obj_Submit = Ext
								.create(
										'Ext.button.Button',
										{
											text : userManager.button.self.C_STR_GENERAL_SAVE,
											formBind : true,
											scope : this,
											handler : function() {
												var str_ID = obj_This.getForm()
														.getValues().id;

												var str_Method = "POST";
												if (str_ID) {
													str_Method = "PUT";
												}

												var form = this.getForm();
												if (form.isValid()) {
													form
															.submit({
																headers : {
																	Accept : "application/json"
																},
																scope : obj_This,
																url : '../rest/group/'
																		+ str_ID,
																waitMsg : userManager.dialog.self.C_STR_APPLICATION_SAVE_WAIT,
																method : str_Method,
																success : obj_This.success_Submit,
																failure : obj_This.fail_Submit
															});
												}

											}
										});

						this.m_obj_Cancel = Ext
								.create(
										'Ext.button.Button',
										{
											text : userManager.button.self.C_STR_GENERAL_CANCEL,
											handler : function() {
												this.ownerCt.ownerCt.ownerCt
														.close();
											}
										});

						this.buttons = [];

						this.buttons.push(this.m_obj_Submit);
						this.buttons.push(this.m_obj_Cancel);

						this.callParent();

						this.add(this.m_obj_Tabs);
					},
					success_Submit : function(obj_Options) {
						this.up("window").close();
						userManager.MsgBus
								.fireEvent(userManager.MsgBus.self.C_STR_EVENT_USER_ADDED);
					},
					fail_Submit : function(obj_Form, obj_Action) {
						var obj_Response = Ext
								.decode(obj_Action.response.responseText);
						var str_Msg = "";

						console.log(obj_Response);

						for (int_Key in obj_Response.errors) {
							str_Msg += obj_Response.errors[int_Key] + "<br/>";
						}

						Ext.Msg.alert("Failed", str_Msg);
					},
					loadGroup : function() {
						this.m_obj_Tabs.loadGroup();
					}
				});