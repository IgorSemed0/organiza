import { Head } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

export default function Show({ item }) {
    return (
        <AdminLayout title="Detalhes do Espaço de Trabalho">
            <Head title="Detalhes do Espaço de Trabalho" />
            <Card>
                <CardHeader>
                    <CardTitle>Detalhes do Espaço de Trabalho</CardTitle>
                </CardHeader>
                <CardContent>
                    <div className="space-y-4">
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Nome</h3>
                            <p className="text-gray-900 dark:text-white">{item.vc_nome}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Descrição</h3>
                            <p className="text-gray-900 dark:text-white">{item.vc_descricao || 'N/A'}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Criador</h3>
                            <p className="text-gray-900 dark:text-white">{item.user_criador?.vc_nome || 'N/A'}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Criado Em</h3>
                            <p className="text-gray-900 dark:text-white">{new Date(item.created_at).toLocaleString('pt-PT')}</p>
                        </div>
                    </div>
                </CardContent>
            </Card>
        </AdminLayout>
    );
}