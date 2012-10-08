Ext
        .define(
                'darkowl.userManager.application.addEdit.cWindow',
                {
                    extend : 'darkowl.desktop.cDesktopWindow',
                    title : "Add/Edit Application",
                    requires :
                    [ 'darkowl.userManager.action.addEdit.cForm'
                    // 'darkowl.userManager.action.view.cGrid'
                    ],
                    iconCls : "window-application-edit-icon",
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
	                            .create('darkowl.userManager.application.addEdit.cForm');

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
                    loadAction : function(str_AppID)
                    {
	                    this.m_obj_Form
	                            .load(
	                            {
	                                headers :
	                                {
		                                Accept : "application/json"
	                                },
	                                url : "../rest/application/" + str_AppID,
	                                method : "get",
	                                success : function(obj_Form, obj_App)
	                                {
		                                this.m_obj_Form.m_str_AppId = obj_App.result.data.application;

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
