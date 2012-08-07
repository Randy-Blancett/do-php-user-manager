Ext
        .define(
                'darkowl.userManager.group.view.cToolbar',
                {
                    extend : 'Ext.toolbar.Toolbar',
                    requires :
                    [ 'Ext.button.Button',
                            'darkowl.userManager.eventManager.cStartMenuEvents' ],
                    initComponent : function()
                    {
	                    this.callParent();

	                    if (g_obj_Config.m_bool_Group_Add)
	                    {
		                    this
		                            .add(new Ext.button.Button(
		                                    {
		                                        text : "Add",
		                                        iconCls : 'toolbar-Group-add-icon',
		                                        tooltip : "Add Group",
		                                        handler : function()
		                                        {
			                                        startMenu.MsgBus
			                                                .fireEvent(startMenu.MsgBus.self.C_STR_EVENT_OPEN_GROUP_ADD);
		                                        }
		                                    }));
	                    }

	                    if (g_obj_Config.m_bool_Group_Edit)
	                    {
		                    this
		                            .add(new Ext.button.Button(
		                                    {
		                                        text : "Edit",
		                                        iconCls : 'toolbar-group-edit-icon',
		                                        tooltip : "Edit Group",
		                                        handler : function()
		                                        {
			                                        startMenu.MsgBus
			                                                .fireEvent(startMenu.MsgBus.self.C_STR_EVENT_OPEN_USER_ADD);
		                                        }
		                                    }));
	                    }

	                    if (g_obj_Config.m_bool_Group_Delete)
	                    {
		                    this
		                            .add(new Ext.button.Button(
		                                    {
		                                        text : "Delete",
		                                        iconCls : 'toolbar-group-delete-icon',
		                                        tooltip : "Delete Group",
		                                        handler : function()
		                                        {
			                                        startMenu.MsgBus
			                                                .fireEvent(startMenu.MsgBus.self.C_STR_EVENT_OPEN_GROUP_ADD);
		                                        }
		                                    }));
	                    }
                    }
                });