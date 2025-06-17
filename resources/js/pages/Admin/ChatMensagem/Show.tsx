import { Head, Link } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

export default function Show({ item }) {
    return (
        <AdminLayout title="Detalhes da Mensagem de Chat">
            <Head title="Detalhes da Mensagem de Chat" />
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between">
                        <CardTitle>Detalhes da Mensagem de Chat</CardTitle>
                        <div className="flex space-x-2">
                            <Link href={route('admin.chat_mensagems.index')}>
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
                            <h3 className="text-sm font-medium text-gray-500">Autor</h3>
                            <p className="text-gray-900 dark:text-white">{item.user_autor?.vc_nome || 'N/A'}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Mensagem</h3>
                            <p className="text-gray-900 dark:text-white">{item.vc_texto_mensagem}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Criado Em</h3>
                            <p className="text-gray-900 dark:text-white">{new Date(item.created_at).toLocaleString('pt-PT')}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500">Anexos</h3>
                            {item.anexos?.length > 0 ? (
                                <ul className="list-disc pl-5">
                                    {item.anexos.map((anexo) => (
                                        <li key={anexo.id} className="text-gray-900 dark:text-white">{anexo.vc_nome_arquivo || 'N/A'}</li>
                                    ))}
                                </ul>
                            ) : (
                                <p className="text-gray-900 dark:text-white">Nenhum anexo</p>
                            )}
                        </div>
                    </div>
                </CardContent>
            </Card>
        </AdminLayout>
    );
}