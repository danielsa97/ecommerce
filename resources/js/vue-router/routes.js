import DepartmentManager from "../components/catalog/department/DepartmentManager";
import BrandManager from "../components/catalog/brand/BrandManager";
import CategoryManager from "../components/catalog/category/CategoryManager";
import Home from "../components/home/Home";
import UserManager from "../components/setting/user/UserManager";
import DiscountManager from "../components/catalog/discount/DiscountManager";
import EcommerceManager from "../components/setting/ecommerce/EcommerceManager";
import ProductManager from "../components/catalog/product/ProductManager";

export default [
    {
        path: '/dashboard',
        children: [
            {
                path: '/',
                menu: {
                    label: "Início",
                    icon: 'fas fa-tachometer-alt',
                },
                meta: {
                    title: 'Início',
                    description: 'Bem-vindo ao sistema'
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
                            label: "Marcas"
                        },
                        meta: {
                            title: 'Marcas',
                            description: 'Gerencie as marcas disponíveis na loja'
                        },
                        component: BrandManager,
                    },
                    {
                        path: 'department',
                        menu: {
                            label: "Departamentos"
                        },
                        meta: {
                            title: 'Departamentos',
                            description: 'Gerencie os departamentos da loja'
                        },
                        component: DepartmentManager,
                    },
                    {
                        path: 'category',
                        menu: {
                            label: "Categorias"
                        },
                        meta: {
                            title: 'Categorias',
                            description: 'Gerencie as categorias da loja'
                        },
                        component: CategoryManager,
                    },
                    {
                        path: 'product',
                        menu: {
                            label: "Produtos"
                        },
                        meta: {
                            title: 'Produtos',
                            description: 'Gerencie os produtos da loja'
                        },
                        component: ProductManager,
                    },
                    {
                        path: 'discount',
                        menu: {
                            label: "Descontos"
                        },
                        meta: {
                            title: 'Descontos',
                            description: 'Gerencie os descontos disponíveis'
                        },
                        component: DiscountManager,
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
                        path: 'ecommerce',
                        menu: {
                            label: "Loja"
                        },
                        meta: {
                            title: 'Configurações da loja',
                            description: 'Configure os parametros da loja'
                        },
                        component: EcommerceManager,
                    },
                    {
                        path: 'user',
                        menu: {
                            label: "Usuários"
                        },
                        meta: {
                            title: 'Usuários',
                            description: 'Gerencie os usuário do sistema'
                        },
                        component: UserManager,
                    }
                ]
            }
        ]
    }
];
