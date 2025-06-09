import { SidebarGroup, SidebarGroupLabel, SidebarMenu, SidebarMenuButton, SidebarMenuItem, SidebarMenuSub, SidebarMenuSubItem, SidebarMenuSubButton } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/react';
import { ChevronDown, ChevronRight } from 'lucide-react';
import React from 'react';

export function NavMain({ items = [] }: { items: NavItem[] }) {
    const page = usePage();
    const [expandedItems, setExpandedItems] = React.useState(new Set<string>());

    const toggleItem = (title: string) => {
        setExpandedItems(prev => {
            const newSet = new Set(prev);
            if (newSet.has(title)) {
                newSet.delete(title);
            } else {
                newSet.add(title);
            }
            return newSet;
        });
    };

    // Separate direct links and sections
    const directLinks = items.filter(item => item.href && !item.items);
    const sections = items.filter(item => item.items);

    return (
        <>
            {directLinks.length > 0 && (
                <SidebarGroup>
                    <SidebarMenu>
                        {directLinks.map((item, index) => (
                            <SidebarMenuItem key={index}>
                                <SidebarMenuButton asChild isActive={item.href === page.url}>
                                    <Link href={item.href} prefetch>
                                        {item.icon && <item.icon />}
                                        <span>{item.title}</span>
                                    </Link>
                                </SidebarMenuButton>
                            </SidebarMenuItem>
                        ))}
                    </SidebarMenu>
                </SidebarGroup>
            )}
            {sections.map((section, sectionIndex) => (
                <SidebarGroup key={sectionIndex}>
                    <SidebarGroupLabel>{section.title}</SidebarGroupLabel>
                    <SidebarMenu>
                        {section.items.map((subItem, subIndex) => (
                            <SidebarMenuItem key={subIndex}>
                                <SidebarMenuButton
                                    onClick={() => toggleItem(subItem.title)}
                                    asChild={false}
                                    className="flex items-center w-full"
                                >
                                    {subItem.icon && <subItem.icon />}
                                    <span className="flex-1 text-left">{subItem.title}</span>
                                    {subItem.items && (
                                        expandedItems.has(subItem.title) ? (
                                            <ChevronDown className="ml-auto h-4 w-4" />
                                        ) : (
                                            <ChevronRight className="ml-auto h-4 w-4" />
                                        )
                                    )}
                                </SidebarMenuButton>
                                {expandedItems.has(subItem.title) && subItem.items && (
                                    <SidebarMenuSub className="pl-6">
                                        {subItem.items.map((subSubItem, subSubIndex) => (
                                            <SidebarMenuSubItem key={subSubIndex}>
                                                <SidebarMenuSubButton
                                                    asChild
                                                    isActive={subSubItem.href === page.url}
                                                    className="w-full text-left"
                                                >
                                                    <Link href={subSubItem.href} prefetch>
                                                        {subSubItem.title}
                                                    </Link>
                                                </SidebarMenuSubButton>
                                            </SidebarMenuSubItem>
                                        ))}
                                    </SidebarMenuSub>
                                )}
                            </SidebarMenuItem>
                        ))}
                    </SidebarMenu>
                </SidebarGroup>
            ))}
        </>
    );
}