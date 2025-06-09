import { Head, router, useForm, Link } from '@inertiajs/react';
import { useState } from 'react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Search } from 'lucide-react';
import { Pagination, PaginationContent, PaginationItem, PaginationLink, PaginationNext, PaginationPrevious } from '@/components/ui/pagination';
import { Alert, AlertDescription } from '@/components/ui/alert';

export default function Trash({ items, filters }) {
    const [search, setSearch] = useState(filters.search || '');
    const { post, delete: deleteRequest, processing, errors, reset } = useForm({});

    const handleSearch = (e: React.FormEvent) => {
        e.preventDefault();
        router.get(route('admin.membro_workplace_convites.trash'), { search }, { preserveState: true });
    };

    const handleRestore = (id: number) => {
        if (confirm('Tem a certeza que deseja restaurar este convite para espaço de trabalho?')) {
            post(route('admin.membro_workplace_convites.restore', id), {
                onSuccess: () => {
                    reset();
                    router.reload({ only: ['items', 'filters'] });
                },
            });
        }
    };

    const handlePurge = (id: number) => {
        if (confirm('Tem a certeza que deseja eliminar permanentemente este convite para espaço de trabalho?')) {
            deleteRequest(route('admin.membro_workplace_convites.purge', id), {
                onSuccess: () => {
                    reset();
                    router.reload({ only: ['items', 'filters'] });
                },
            });
        }
    };

    return (
        <AdminLayout title="Lixo de Convites para Espaços de Trabalho">
            <Head title="Lixo de Convites para Espaços de Trabalho" />
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between">
                        <CardTitle>Lixo de Convites para Espaços de Trabalho</CardTitle>
                        <div className="flex space-x-2">
                            <Link href={route('admin.membro_workplace_convites.index')}>
                                <Button variant="outline">Voltar</Button>
                            </Link>
                        </div>
                    </div>
                </CardHeader>
                <CardContent>
                    {Object.keys(errors).length > 0 && (
                        <Alert variant="destructive" className="mb-4">
                            <AlertDescription>
                                {errors.message || 'Ocorreu um erro ao processar o seu pedido.'}
                            </AlertDescription>
                        </Alert>
                    )}
                    <form onSubmit={handleSearch} className="mb-4 flex space-x-2">
                        <div className="relative flex-1">
                            <Search className="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" />
                            <Input
                                type="text"
                                placeholder="Pesquisar convite para espaço de trabalho eliminado..."
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
                                    <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Espaço de Trabalho</th>
                                    <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Convidado</th>
                                    <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Convidador</th>
                                    <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Status</th>
                                    <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Eliminado Em</th>
                                    <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Ações</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                                {items.data.map((item) => (
                                    <tr key={item.id}>
                                        <td className="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">{item.workplace?.vc_nome || 'N/A'}</td>
                                        <td className="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-300">{item.user_convidado?.vc_nome || 'N/A'}</td>
                                        <td className="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-300">{item.user_convidador?.vc_nome || 'N/A'}</td>
                                        <td className="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-300">{item.vc_status}</td>
                                        <td className="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-300">{new Date(item.deleted_at).toLocaleDateString('pt-PT')}</td>
                                        <td className="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                            <div className="flex space-x-2">
                                                <Button
                                                    variant="outline"
                                                    size="sm"
                                                    onClick={() => handleRestore(item.id)}
                                                    disabled={processing}
                                                >
                                                    Restaurar
                                                </Button>
                                                <Button
                                                    variant="destructive"
                                                    size="sm"
                                                    onClick={() => handlePurge(item.id)}
                                                    disabled={processing}
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