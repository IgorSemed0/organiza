import { Head, Link, router } from '@inertiajs/react';
import { useState } from 'react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Plus, Search, Trash2 } from 'lucide-react';
import { Pagination, PaginationContent, PaginationItem, PaginationLink, PaginationNext, PaginationPrevious } from '@/components/ui/pagination';

export default function Index({ items, filters }) {
    const [search, setSearch] = useState(filters.search || '');

    const handleSearch = (e: React.FormEvent) => {
        e.preventDefault();
        router.get(route('admin.anexos.index'), { search }, { preserveState: true });
    };

    const handleDelete = (id: number) => {
        if (confirm('Tem a certeza que deseja eliminar este anexo?')) {
            router.delete(route('admin.anexos.destroy', id));
        }
    };

    return (
        <AdminLayout title="Gestão de Anexos">
            <Head title="Gestão de Anexos" />
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between">
                        <CardTitle>Gestão de Anexos</CardTitle>
                        <div className="flex space-x-2">
                            <Link href={route('admin.anexos.trash')}>
                                <Button variant="outline">
                                    <Trash2 className="mr-2 h-4 w-4" />
                                    Lixo
                                </Button>
                            </Link>
                            <Link href={route('admin.anexos.create')}>
                                <Button>
                                    <Plus className="mr-2 h-4 w-4" />
                                    Criar Anexo
                                </Button>
                            </Link>
                        </div>
                    </div>
                </CardHeader>
                <CardContent>
                    <form onSubmit={handleSearch} className="mb-4 flex space-x-2">
                        <div className="relative flex-1">
                            <Search className="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" />
                            <Input
                                type="text"
                                placeholder="Pesquisar anexo..."
                                value={search}
                                onChange={(e) => setSearch(e.target.value)}
                                className="pl-10"
                            />
                        </div>
                        <Button type="submit">Pesquisar</Button>
                    </form>
                    <div className="overflow-x-auto">
                        <table className="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead className="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Cartão</th>
                                    <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Utilizador que Carregou</th>
                                    <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Nome do Arquivo</th>
                                    <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Criado Em</th>
                                    <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Ações</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                                {items.data.map((item) => (
                                    <tr key={item.id}>
                                        <td className="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">{item.cartao?.vc_titulo || 'N/A'}</td>
                                        <td className="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-300">{item.user_upload?.vc_nome || 'N/A'}</td>
                                        <td className="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-300">{item.vc_nome_arquivo}</td>
                                        <td className="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-300">{new Date(item.created_at).toLocaleDateString('pt-PT')}</td>
                                        <td className="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                            <div className="flex space-x-2">
                                                <Link href={route('admin.anexos.show', item.id)}>
                                                    <Button variant="outline" size="sm">Ver</Button>
                                                </Link>
                                                <Link href={route('admin.anexos.edit', item.id)}>
                                                    <Button variant="outline" size="sm">Editar</Button>
                                                </Link>
                                                <Button
                                                    variant="destructive"
                                                    size="sm"
                                                    onClick={() => handleDelete(item.id)}
                                                >
                                                    Eliminar
                                                </Button>
                                            </div>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                    {items.links && (
                        <Pagination className="mt-4">
                            <PaginationContent>
                                {items.links.map((link, index) => (
                                    <PaginationItem key={index}>
                                        {link.url ? (
                                            link.label.includes('Previous') ? (
                                                <PaginationPrevious href={link.url} />
                                            ) : link.label.includes('Next') ? (
                                                <PaginationNext href={link.url} />
                                            ) : (
                                                <PaginationLink href={link.url} isActive={link.active}>
                                                    {link.label}
                                                </PaginationLink>
                                            )
                                        ) : null}
                                    </PaginationItem>
                                ))}
                            </PaginationContent>
                        </Pagination>
                    )}
                </CardContent>
            </Card>
        </AdminLayout>
    );
}