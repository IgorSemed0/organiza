import { Head } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

export default function Show({ item }) {
    return (
        <AdminLayout title="Detalhes do Membro de Espaço de Trabalho">
            <Head title="Detalhes do Membro de Espaço de Trabalho" />
            <Card>
                <CardHeader>
                    <CardTitle>Detalhes do Membro de Espaço de Trabalho</CardTitle>
                </CardHeader>
                <CardContent>
                    <div className="space-y-4">
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Espaço de Trabalho</h3>
                            <p className="text-gray-900 dark:text-white">{item.workplace?.vc_nome || 'N/A'}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Utilizador</h3>
                            <p className="text-gray-900 dark:text-white">{item.user?.vc_nome || 'N/A'}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Função</h3>
                            <p className="text-gray-900 dark:text-white">{item.vc_funcao}</p>
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