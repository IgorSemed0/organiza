import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/react';
import { 
    BookOpen, 
    Folder, 
    LayoutGrid, 
    Users, 
    UserCheck, 
    Briefcase, 
    KanbanSquare, 
    FileText, 
    Paperclip, 
    MessageSquare, 
    UserPlus, 
    Mail 
} from 'lucide-react';
import AppLogo from './app-logo';

const mainNavItems: NavItem[] = [
    {
        title: 'Painel',
        href: route('dashboard'),
        icon: LayoutGrid,
    },
    {
        title: 'Gestão de Utilizadores',
        icon: Users,
        items: [
            {
                title: 'Utilizadores',
                href: route('admin.users.index'),
                icon: UserCheck,
                items: [
                    { title: 'Lista', href: route('admin.users.index') },
                    { title: 'Lixo', href: route('admin.users.trash') },
                ],
            },
            {
                title: 'Tipos de Utilizadores',
                href: route('admin.tipo_users.index'),
                icon: UserCheck,
                items: [
                    { title: 'Lista', href: route('admin.tipo_users.index') },
                    { title: 'Lixo', href: route('admin.tipo_users.trash') },
                ],
            },
        ],
    },
    {
        title: 'Gestão de Espaços de Trabalho',
        icon: Briefcase,
        items: [
            {
                title: 'Espaços de Trabalho',
                href: route('admin.workplaces.index'),
                icon: Briefcase,
                items: [
                    { title: 'Lista', href: route('admin.workplaces.index') },
                    { title: 'Lixo', href: route('admin.workplaces.trash') },
                ],
            },
            {
                title: 'Membros de Espaços de Trabalho',
                href: route('admin.membro_workplaces.index'),
                icon: UserPlus,
                items: [
                    { title: 'Lista', href: route('admin.membro_workplaces.index') },
                    { title: 'Lixo', href: route('admin.membro_workplaces.trash') },
                ],
            },
        ],
    },
    {
        title: 'Gestão de Quadros',
        icon: KanbanSquare,
        items: [
            {
                title: 'Quadros',
                href: route('admin.quadros.index'),
                icon: KanbanSquare,
                items: [
                    { title: 'Lista', href: route('admin.quadros.index') },
                    { title: 'Lixo', href: route('admin.quadros.trash') },
                ],
            },
            {
                title: 'Membros de Quadros',
                href: route('admin.membro_quadros.index'),
                icon: UserPlus,
                items: [
                    { title: 'Lista', href: route('admin.membro_quadros.index') },
                    { title: 'Lixo', href: route('admin.membro_quadros.trash') },
                ],
            },
        ],
    },
    {
        title: 'Gestão de Cartões',
        icon: FileText,
        items: [
            {
                title: 'Cartões',
                href: route('admin.cartaos.index'),
                icon: FileText,
                items: [
                    { title: 'Lista', href: route('admin.cartaos.index') },
                    { title: 'Lixo', href: route('admin.cartaos.trash') },
                ],
            },
            {
                title: 'Membros de Cartões',
                href: route('admin.membro_cartaos.index'),
                icon: UserPlus,
                items: [
                    { title: 'Lista', href: route('admin.membro_cartaos.index') },
                    { title: 'Lixo', href: route('admin.membro_cartaos.trash') },
                ],
            },
        ],
    },
    {
        title: 'Gestão de Anexos',
        icon: Paperclip,
        items: [
            {
                title: 'Anexos',
                href: route('admin.anexos.index'),
                icon: Paperclip,
                items: [
                    { title: 'Lista', href: route('admin.anexos.index') },
                    { title: 'Lixo', href: route('admin.anexos.trash') },
                ],
            },
            {
                title: 'Anexos de Conversas',
                href: route('admin.chat_anexos.index'),
                icon: Paperclip,
                items: [
                    { title: 'Lista', href: route('admin.chat_anexos.index') },
                    { title: 'Lixo', href: route('admin.chat_anexos.trash') },
                ],
            },
        ],
    },
    {
        title: 'Gestão de Comentários',
        icon: MessageSquare,
        items: [
            {
                title: 'Comentários',
                href: route('admin.comentarios.index'),
                icon: MessageSquare,
                items: [
                    { title: 'Lista', href: route('admin.comentarios.index') },
                    { title: 'Lixo', href: route('admin.comentarios.trash') },
                ],
            },
        ],
    },
    {
        title: 'Gestão de Conversas',
        icon: MessageSquare,
        items: [
            {
                title: 'Mensagens de Conversas',
                href: route('admin.chat_mensagens.index'),
                icon: MessageSquare,
                items: [
                    { title: 'Lista', href: route('admin.chat_mensagens.index') },
                    { title: 'Lixo', href: route('admin.chat_mensagens.trash') },
                ],
            },
        ],
    },
    {
        title: 'Gestão de Convites',
        icon: Mail,
        items: [
            {
                title: 'Convites para Quadros',
                href: route('admin.membro_quadro_convites.index'),
                icon: Mail,
                items: [
                    { title: 'Lista', href: route('admin.membro_quadro_convites.index') },
                    { title: 'Lixo', href: route('admin.membro_quadro_convites.trash') },
                ],
            },
            {
                title: 'Convites para Espaços de Trabalho',
                href: route('admin.membro_workplace_convites.index'),
                icon: Mail,
                items: [
                    { title: 'Lista', href: route('admin.membro_workplace_convites.index') },
                    { title: 'Lixo', href: route('admin.membro_workplace_convites.trash') },
                ],
            },
        ],
    },
    {
        title: 'Relatórios',
        href: route('admin.reports.index'),
        icon: FileText,
    },
];

const footerNavItems: NavItem[] = [];

export function AppSidebar() {
    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href="/dashboard" prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={mainNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter items={footerNavItems} className="mt-auto" />
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}