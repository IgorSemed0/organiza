import { Head, Link } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

export default function Show({ item }) {
    return (
        <AdminLayout title="Detalhes do Membro de Quadro">
            <Head title="Detalhes do Membro de Quadro" />
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between">
                        <CardTitle>Detalhes do Membro de Quadro</CardTitle>
                        <div className="flex space-x-2">
                            <Link href={route('admin.membro_quadros.index')}>
                                <Button variant="outline">Voltar</Button>
                            </Link>
                        </div>
                    </div>
                </CardHeader>
                <CardContent>
                    <div className="space-y-4">
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Quadro</h3>
                            <p className="text-gray-900 dark:text-white">{item.quadro?.vc_nome || 'N/A'}</p>
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