import { Head, useForm, Link } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

export default function Create({ chatMensagens, users }) {
    const { data, setData, post, processing, errors } = useForm({
        it_id_chat_mensagem: '',
        it_id_user_upload: '',
        vc_nome_arquivo: '',
        vc_caminho_arquivo: '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('admin.chat_anexos.store'));
    };

    return (
        <AdminLayout title="Criar Anexo de Chat">
            <Head title="Criar Anexo de Chat" />
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between">
                        <CardTitle>Criar Anexo de Chat</CardTitle>
                        <div className="flex space-x-2">
                            <Link href={route('admin.chat_anexos.index')}>
                                <Button variant="outline">Voltar</Button>
                            </Link>
                        </div>
                    </div>
                </CardHeader>
                <CardContent>
                    <form onSubmit={handleSubmit} className="space-y-4">
                        <div>
                            <Label htmlFor="it_id_chat_mensagem">Mensagem de Chat</Label>
                            <Select
                                value={data.it_id_chat_mensagem}
                                onValueChange={(value) => setData('it_id_chat_mensagem', value)}
                            >
                                <SelectTrigger id="it_id_chat_mensagem" className={errors.it_id_chat_mensagem ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Selecione uma mensagem" />
                                </SelectTrigger>
                                <SelectContent>
                                    {chatMensagens.map((mensagem) => (
                                        <SelectItem key={mensagem.id} value={mensagem.id.toString()}>
                                            {mensagem.vc_texto_mensagem}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {errors.it_id_chat_mensagem && <p className="text-sm text-red-500">{errors.it_id_chat_mensagem}</p>}
                        </div>
                        <div>
                            <Label htmlFor="it_id_user_upload">Utilizador que Carregou</Label>
                            <Select
                                value={data.it_id_user_upload}
                                onValueChange={(value) => setData('it_id_user_upload', value)}
                            >
                                <SelectTrigger id="it_id_user_upload" className={errors.it_id_user_upload ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Selecione um utilizador" />
                                </SelectTrigger>
                                <SelectContent>
                                    {users.map((user) => (
                                        <SelectItem key={user.id} value={user.id.toString()}>
                                            {user.vc_nome}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {errors.it_id_user_upload && <p className="text-sm text-red-500">{errors.it_id_user_upload}</p>}
                        </div>
                        <div>
                            <Label htmlFor="vc_nome_arquivo">Nome do Arquivo</Label>
                            <Input
                                id="vc_nome_arquivo"
                                type="text"
                                value={data.vc_nome_arquivo}
                                onChange={(e) => setData('vc_nome_arquivo', e.target.value)}
                                className={errors.vc_nome_arquivo ? 'border-red-500' : ''}
                            />
                            {errors.vc_nome_arquivo && <p className="text-sm text-red-500">{errors.vc_nome_arquivo}</p>}
                        </div>
                        <div>
                            <Label htmlFor="vc_caminho_arquivo">Caminho do Arquivo</Label>
                            <Input
                                id="vc_caminho_arquivo"
                                type="text"
                                value={data.vc_caminho_arquivo}
                                onChange={(e) => setData('vc_caminho_arquivo', e.target.value)}
                                className={errors.vc_caminho_arquivo ? 'border-red-500' : ''}
                            />
                            {errors.vc_caminho_arquivo && <p className="text-sm text-red-500">{errors.vc_caminho_arquivo}</p>}
                        </div>
                        <div className="flex space-x-2">
                            <Button type="submit" disabled={processing}>Criar</Button>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </AdminLayout>
    );
}