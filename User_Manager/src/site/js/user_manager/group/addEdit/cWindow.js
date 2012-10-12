Ext
        .define(
                'darkowl.userManager.group.addEdit.cWindow',
                {
                    extend : 'darkowl.desktop.cDesktopWindow',
                    title : "Add/Edit Group",
                    requires :
                    [ 'darkowl.userManager.group.addEdit.cForm'
                    // 'darkowl.userManager.action.view.cGrid'
                    ],
                    iconCls : "window-group-edit-icon",
                    width : 600,
                    height : 300,
                    shim : false,
                    animCollapse : false,
                    constrain : true,
                    m_str_ID : "",
                    layout : "fit",
                    border : false,
                    m_obj_Mask : null,
                    initComponent : function()
                    {
	                    var obj_This = this;

	                    this.m_obj_Form = Ext
	                            .create('darkowl.userManager.group.addEdit.cForm');

	                    this.callParent();

	                    this.add(this.m_obj_Form);

	                    if (this.m_str_ID)
	                    {
		                    this.showMask();
		                    this.loadAction(this.m_str_ID);
	                    }
	                    this.on("afterrender", function()
	                    {
		                    if (this.m_bool_Mask)
		                    {
			                    this.showMask();
		                    }
	                    });
                    },
                    loadAction : function(str_GroupID)
                    {
	                    this.m_obj_Form
	                            .load(
	                            {
	                                headers :
	                                {
		                                Accept : "application/json"
	                                },
	                                url : "../rest/group/" + str_GroupID,
	                                method : "get",
	                                success : function(obj_Form, obj_Group)
	                                {
		                                this.m_obj_Form.m_str_GroupID = obj_Group.result.data.application;

		                                this.hideMask();
	                                },
	                                failure : function()
	                                {
		                                this.hideMask();
	                                },
	                                scope : this
	                            });

                    },
                    showMask : function()
                    {
	                    this.m_bool_Mask = true;
	                    if (this.getEl())
	                    {
		                    if (!this.m_obj_Mask)
		                    {
			                    this.m_obj_Mask = new Ext.LoadMask(
			                            this.getEl(),
			                            {
				                            msg : "Loading Data..."
			                            });
		                    }
		                    this.m_obj_Mask.show();
	                    }
                    },
                    hideMask : function()
                    {
	                    this.m_bool_Mask = true;
	                    if (this.getEl())
	                    {
		                    if (!this.m_obj_Mask)
		                    {
			                    return;
		                    }
		                    this.m_obj_Mask.hide();
	                    }
                    }
                });
