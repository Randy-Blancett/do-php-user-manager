Ext
		.define(
				'darkowl.userManager.group.addEdit.cTabForm',
				{
					requires : [
							'darkowl.userManager.group.addEdit.tabs.cGroupInfo',
							'darkowl.userManager.permission.cPermissions' ],
					extend : 'Ext.tab.Panel',
					border : false,
					activeTab : 0,
					initComponent : function() {
						var obj_This = this;

						this.m_obj_Tab_GroupInfo = Ext
								.create('darkowl.userManager.group.addEdit.tabs.cGroupInfo');

						this.m_obj_Tab_Permissions = Ext
								.create(
										'darkowl.userManager.permission.cPermissions',
										{
											m_int_Type : darkowl.userManager.permission.cPermissions.C_INT_TYPE_GROUP
										});

						this.callParent();
						this.add(this.m_obj_Tab_GroupInfo,
								this.m_obj_Tab_Permissions);
					},
					getGroupID : function() {
						return this.m_obj_Tab_GroupInfo.getGroupID();
					},
					loadGroup : function() {
						 this.m_obj_Tab_Permissions.loadId(this.getGroupID());
					}
				});