import { Head, Link } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

export default function Show({ item }) {
    return (
        <AdminLayout title="Detalhes do Comentário">
            <Head title="Detalhes do Comentário" />
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between">
                        <CardTitle>Detalhes do Comentário</CardTitle>
                        <div className="flex space-x-2">
                            <Link href={route('admin.comentarios.index')}>
                                <Button variant="outline">Voltar</Button>
                            </Link>
                        </div>
                    </div>
                </CardHeader>
                <CardContent>
                    <div className="space-y-4">
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Cartão</h3>
                            <p className="text-gray-900 dark:text-white">{item.cartao?.vc_titulo || 'N/A'}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Autor</h3>
                            <p className="text-gray-900 dark:text-white">{item.user_autor?.vc_nome || 'N/A'}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Texto</h3>
                            <p className="text-gray-900 dark:text-white">{item.vc_texto}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Criado em</h3>
                            <p className="text-gray-900 dark-text-white">{new Date(item.created_at).toLocaleString('pt-PT')}</p>
                        </div>
                    </div>
                </CardContent>
            </Card>
        </AdminLayout>
    );
}