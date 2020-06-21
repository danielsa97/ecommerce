import DepartmentManager from "../components/catalog/department/DepartmentManager";
import BrandManager from "../components/catalog/brand/BrandManager";
import CategoryManager from "../components/catalog/category/CategoryManager";
import Home from "../components/home/Home";
import UserManager from "../components/setting/user/UserManager";

export default [
    {
        path: '/dashboard',
        children: [
            {
                path: '',
                menu: {
                    label: "Home",
                    icon: 'fas fa-tachometer-alt',
                },
                component: Home,
            },
            //Catalog
            {
                path: 'catalog',
                menu: {
                    label: "Catálogo",
                    icon: 'fas fa-box'
                },
                children: [
                    {
                        path: 'brand',
                        menu: {
                            label: "Marca"
                        },
                        component: BrandManager,
                    },
                    {
                        path: 'category',
                        menu: {
                            label: "Categoria"
                        },
                        component: CategoryManager,
                    },
                    {
                        path: 'department',
                        menu: {
                            label: "Departamento"
                        },
                        component: DepartmentManager,
                    },
                ]
            },
            //Setting
            {
                path: 'setting',
                menu: {
                    label: "Configuração",
                    icon: 'fa fa-cog'
                },
                children: [
                    {
                        path: 'user',
                        menu: {
                            label: "Usuários"
                        },
                        component: UserManager,
                    }
                ]
            }
        ]
    }
];
